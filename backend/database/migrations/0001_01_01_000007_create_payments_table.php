<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('payment_method', 50);
            $table->string('transaction_id', 255)->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('status', 50)->default('pending');
            $table->json('payment_data')->nullable(); // store gateway responses
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};