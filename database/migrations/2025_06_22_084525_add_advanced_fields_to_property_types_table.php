<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            // For parent-child hierarchy
            $table->foreignId('parent_id')->nullable()->after('id')->constrained('property_types')->onDelete('set null');
            
            // For a simple icon class like Font Awesome
            $table->string('icon')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'icon']);
        });
    }
};