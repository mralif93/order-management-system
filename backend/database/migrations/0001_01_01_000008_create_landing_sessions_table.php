<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_sessions', function (Blueprint $table) {
            $table->id();
            $table->uuid('session_uuid')->unique();
            $table->string('visitor_id')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->text('landing_page')->nullable();
            $table->text('referrer')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('converted')->default(false);
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_sessions');
    }
};