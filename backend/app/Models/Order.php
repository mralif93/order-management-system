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

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'order_status',
        'subtotal_amount',
        'discount_amount',
        'shipping_amount',
        'tax_amount',
        'total_amount',
        'currency',
        'notes',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
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