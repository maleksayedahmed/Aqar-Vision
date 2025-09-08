<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This will make the 'ad_id' column nullable.
     */
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // Change the ad_id column to allow NULL values.
            $table->unsignedBigInteger('ad_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     * This will make the 'ad_id' column NOT nullable again.
     */
    public function down(): void
    {
        DB::table('conversations')->whereNull('ad_id')->delete();
        Schema::table('conversations', function (Blueprint $table) {
            // This is the reverse operation, useful if you ever need to roll back.
            $table->unsignedBigInteger('ad_id')->nullable(false)->change();
        });
    }
};