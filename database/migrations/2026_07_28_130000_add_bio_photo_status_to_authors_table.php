<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('name');
            $table->string('photo')->nullable()->after('bio');
            $table->boolean('status')->default(1)->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['bio', 'photo', 'status']);
        });
    }
};
