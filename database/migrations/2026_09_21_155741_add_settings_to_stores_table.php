<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->boolean('accept_orders')->default(true)->after('status');
            $table->boolean('auto_approve_orders')->default(false)->after('accept_orders');
            $table->unsignedInteger('processing_time')->default(1)->after('auto_approve_orders');
            $table->decimal('minimum_order_amount', 10, 2)->default(0)->after('processing_time');
            $table->text('order_note')->nullable()->after('minimum_order_amount');
        });
    }

    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'accept_orders',
                'auto_approve_orders',
                'processing_time',
                'minimum_order_amount',
                'order_note',
            ]);
        });
    }
};