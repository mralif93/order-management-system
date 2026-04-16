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
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('store_slug')->unique()->nullable()->after('is_locked');
            $table->string('store_name')->nullable()->after('store_slug');
            $table->text('store_bio')->nullable()->after('store_name');
        });
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn(['store_slug', 'store_name', 'store_bio']);
        });
    }
};
