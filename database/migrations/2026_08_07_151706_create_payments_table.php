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

            $table->string('transaction_id')->unique();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('payment_method', [
                'cash_on_delivery',
                'credit_card',
                'debit_card',
                'paypal'
            ])->default('cash_on_delivery');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};