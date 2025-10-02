<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        // Before changing the column to be non-nullable, we need to ensure there are no null values.
        // We'll update all agencies with a null agency_type_id to a default value (1).
        DB::table('agencies')->whereNull('agency_type_id')->update(['agency_type_id' => 1]);

        Schema::table('agencies', function (Blueprint $table) {
            // This is the reverse operation.
            $table->unsignedBigInteger('agency_type_id')->nullable(false)->change();
        });
    }
};
