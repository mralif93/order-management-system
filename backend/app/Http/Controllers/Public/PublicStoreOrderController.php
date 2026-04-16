<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublicStoreOrderController extends Controller
{
    /**
     * Normalise a phone string to digits only and return common variants
     * (e.g. "0123456789" → ["0123456789", "60123456789"]).
     */
    private function phoneVariants(string $phone): array
    {
        $digits = preg_replace('/\D/', '', $phone);
        $variants = [$digits];

        if (str_starts_with($digits, '0')) {
            $variants[] = '60' . substr($digits, 1);
        } elseif (str_starts_with($digits, '60')) {
            $variants[] = '0' . substr($digits, 2);
        } elseif (str_starts_with($digits, '+60')) {
            $variants[] = '0' . substr($digits, 3);
        }

        return $variants;
    }

    /**
     * Look up a registered customer by phone number.
     * Called by the shop landing page on phone-field blur.
     */
    public function lookupCustomer(Request $request, string $slug): JsonResponse
    {
        // $slug is present so the route can be scoped to a specific shop (future use)
        $phone = $request->query('phone', '');
        if (blank($phone)) {
            return response()->json(['found' => false]);
        }

        $customer = Customer::whereIn('phone', $this->phoneVariants($phone))
            ->where('is_active', true)
            ->first();

        if (!$customer) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'name' => $customer->name,
        ]);
    }

    public function store(Request $request, string $slug): JsonResponse
    {
        $seller = Seller::where('store_slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'notes' => 'nullable|string|max:1000',
            'method' => 'nullable|string|in:whatsapp,system,both',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Validate every product belongs to this seller, is active, and has stock
        $productIds = collect($validated['items'])->pluck('product_id');
        $products = Product::where('seller_id', $seller->id)
            ->where('is_active', true)
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        foreach ($validated['items'] as $item) {
            $product = $products->get($item['product_id']);
            if (!$product) {
                return response()->json(['error' => 'One or more products are unavailable.'], 422);
            }
            if ($product->quantity < $item['quantity']) {
                return response()->json(['error' => "Not enough stock for \"{$product->name}\"."], 422);
            }
        }

        // ── Resolve customer (registered or guest) ──────────────────────────────
        $customer = Customer::whereIn('phone', $this->phoneVariants($validated['phone']))
            ->where('is_active', true)
            ->first();

        // ── Duplicate detection ─────────────────────────────────────────────────
        // Same seller + same customer/phone + overlapping product set within 15 min
        $dupQuery = Order::where('seller_id', $seller->id)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->latest();

        if ($customer) {
            $dupQuery->where('customer_id', $customer->id);
        } else {
            $dupQuery->where('guest_phone', $validated['phone']);
        }

        $recentOrder = $dupQuery->first();

        if ($recentOrder) {
            $recentIds = $recentOrder->items()->pluck('product_id')->sort()->values()->toArray();
            $newIds = $productIds->sort()->values()->toArray();

            if ($recentIds === $newIds) {
                return response()->json([
                    'duplicate' => true,
                    'order_number' => $recentOrder->order_number,
                    'minutes_ago' => max(1, (int) $recentOrder->created_at->diffInMinutes(now())),
                ]);
            }
        }

        // ── Create order ────────────────────────────────────────────────────────
        DB::beginTransaction();
        try {
            $subtotal = collect($validated['items'])->reduce(function ($carry, $item) use ($products) {
                $p = $products->get($item['product_id']);
                return $carry + ($p->price * $item['quantity']);
            }, 0.0);

            $deliveryFee = (float) ($seller->delivery_fee ?? 0);
            $total = $subtotal + $deliveryFee;

            // Unique order number (WA-YYYYMMDD-XXXXX)
            do {
                $orderNumber = 'WA-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            } while (Order::where('order_number', $orderNumber)->exists());

            $order = Order::create([
                'seller_id' => $seller->id,
                'customer_id' => $customer?->id,
                'guest_name' => $customer ? null : $validated['name'],
                'guest_phone' => $customer ? null : $validated['phone'],
                'order_number' => $orderNumber,
                'order_status' => 'pending',
                'subtotal_amount' => $subtotal,
                'shipping_amount' => $deliveryFee,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'total_amount' => $total,
                'currency' => 'MYR',
                'notes' => $validated['notes'] ?? null,
                'source' => match ($validated['method'] ?? 'whatsapp') {
                    'system' => 'online',
                    'both' => 'whatsapp_online',
                    default => 'whatsapp',
                },
            ]);

            foreach ($validated['items'] as $item) {
                $p = $products->get($item['product_id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $p->price,
                    'total_price' => $p->price * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_number' => $orderNumber,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Could not place order. Please try again.'], 500);
        }
    }
}

