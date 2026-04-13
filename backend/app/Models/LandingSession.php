<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'session_id',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'landing_page',
        'ip_address',
        'user_agent',
        'referrer_url',
        'session_start',
        'session_end',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

?>