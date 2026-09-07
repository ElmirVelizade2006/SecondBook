<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            // Basic Information
            $table->string('name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Account
            $table->enum('role', ['admin', 'user'])->default('user');

            // Profile
            $table->string('profile_photo')->nullable();
            $table->string('phone')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->enum('gender', [
                'male',
                'female',
                'prefer_not_to_say'
            ])->nullable();

            // Address
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address')->nullable();

            // About
            $table->text('bio')->nullable();

            // Preferences
            $table->boolean('receive_email_notifications')->default(true);
            $table->boolean('receive_order_updates')->default(true);
            $table->boolean('receive_promotional_emails')->default(false);
            $table->boolean('profile_visibility')->default(true);

            // Login Information
            $table->timestamp('last_login_at')->nullable();

            $table->rememberToken();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};