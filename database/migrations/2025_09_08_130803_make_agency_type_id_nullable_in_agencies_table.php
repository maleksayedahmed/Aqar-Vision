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
        Schema::table('agencies', function (Blueprint $table) {
            // Change the agency_type_id column to allow NULL values.
            $table->unsignedBigInteger('agency_type_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agencies', function (Blueprint $table) {
            // This is the reverse operation.
            // Note: This might fail if you have agencies with a null type.
            $table->unsignedBigInteger('agency_type_id')->nullable(false)->change();
        });
    }
};