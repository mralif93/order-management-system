<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('order_number', 50)->unique();
            $table->string('order_status', 50)->default('pending');
            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('shipping_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_number');
            $table->index('order_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};