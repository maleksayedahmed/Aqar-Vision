<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('ads', function (Blueprint $table) {
        // Add latitude and longitude columns after the 'street' column
        // Using decimal for high precision.
        $table->decimal('latitude', 10, 7)->nullable()->after('street');
        $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
    });
}

public function down(): void
{
    Schema::table('ads', function (Blueprint $table) {
        $table->dropColumn(['latitude', 'longitude']);
    });
}
};
