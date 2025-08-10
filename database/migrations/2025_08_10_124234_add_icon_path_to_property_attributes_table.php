<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_attributes', function (Blueprint $table) {
            // Add a nullable string column to store the path of the uploaded icon
            $table->string('icon_path')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('property_attributes', function (Blueprint $table) {
            $table->dropColumn('icon_path');
        });
    }
};