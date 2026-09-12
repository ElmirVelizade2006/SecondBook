<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();

            $table->enum('type', [
                'percentage',
                'fixed'
            ]);

            $table->decimal('value', 10, 2);

            $table->decimal('minimum_order_amount', 10, 2)
                ->default(0);

            $table->decimal('maximum_discount_amount', 10, 2)
                ->nullable();

            $table->unsignedInteger('usage_limit')
                ->nullable();

            $table->unsignedInteger('used_count')
                ->default(0);

            $table->dateTime('starts_at');

            $table->dateTime('expires_at');

            $table->boolean('status')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};