<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Coupon;
use App\Models\LandingSession;
use App\Models\Seller;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'seller_id',
        'guest_name',
        'guest_phone',
        'order_number',
        'order_status',
        'subtotal_amount',
        'discount_amount',
        'shipping_amount',
        'tax_amount',
        'total_amount',
        'currency',
        'notes',
        'seller_remarks',
        'source',
        'whatsapp_sent_at',
    ];

    protected $casts = [
        'whatsapp_sent_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /** Returns customer display name — works for both registered and guest customers */
    public function getCustomerNameAttribute(): string
    {
        return $this->customer->name ?? $this->guest_name ?? 'Guest';
    }

    /** Returns customer display phone */
    public function getCustomerPhoneAttribute(): ?string
    {
        return $this->customer->phone ?? $this->guest_phone;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'order_coupons');
    }

    public function landingSession(): HasOne
    {
        return $this->hasOne(LandingSession::class);
    }
}

?>