<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Make customer_id nullable to support guest orders
            $table->dropForeign(['customer_id']);
            $table->foreignId('customer_id')->nullable()->change();
            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();

            // Direct seller link (no longer need to traverse items → product → seller)
            $table->foreignId('seller_id')->nullable()->after('customer_id')
                ->constrained('sellers')->nullOnDelete();

            // Guest checkout info (used when no customer account)
            $table->string('guest_name', 255)->nullable()->after('seller_id');
            $table->string('guest_phone', 30)->nullable()->after('guest_name');

            // Order source: 'whatsapp', 'system', etc.
            $table->string('source', 50)->nullable()->default('system')->after('notes');

            $table->index('seller_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['seller_id']);
            $table->dropColumn(['seller_id', 'guest_name', 'guest_phone', 'source']);

            $table->dropForeign(['customer_id']);
            $table->foreignId('customer_id')->nullable(false)->change();
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }
};
