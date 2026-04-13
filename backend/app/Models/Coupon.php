<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'is_active',
        'expires_at',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_coupons');
    }
}

?>