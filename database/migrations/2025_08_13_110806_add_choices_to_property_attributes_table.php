<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_attributes', function (Blueprint $table) {
            // Add this line to store dropdown options as JSON
            $table->json('choices')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('property_attributes', function (Blueprint $table) {
            $table->dropColumn('choices');
        });
    }
};