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
        Schema::table('users', function (Blueprint $table) {
            // Add the 'is_active' column.
            // It's a boolean (tinyint(1) in MySQL).
            // We'll make it default to 'true' (active) for any new users.
            // 'after('password')' just keeps the table structure clean.
            $table->boolean('is_active')->default(true)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // This tells Laravel how to undo the migration if you ever need to.
            $table->dropColumn('is_active');
        });
    }
};