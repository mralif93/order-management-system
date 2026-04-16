<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SellerOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get the order ID if it exists in the route (e.g., /seller/orders/{order})
        $orderId = $this->route('order') ? $this->route('order')->id : null;

        return [
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string',
        ];
    }
}