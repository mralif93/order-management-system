<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2); // price at time of purchase
            // In Laravel, we can use a computed column or handle total_price in the model.
            // Here we define the column but let the application set it, or use a virtual accessor.
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};