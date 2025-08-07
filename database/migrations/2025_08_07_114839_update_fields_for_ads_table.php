<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('ads', function (Blueprint $table) {
        // Add new foreign key columns
        $table->foreignId('property_type_id')->nullable()->after('ad_price_id')->constrained()->onDelete('set null');
        $table->foreignId('district_id')->nullable()->after('property_type_id')->constrained()->onDelete('set null');

        // Remove old text-based columns
        $table->dropColumn(['property_type', 'city', 'neighborhood', 'province', 'street']);
        
        // Rename columns to match Property model for consistency
        $table->renameColumn('price', 'total_price');
        $table->renameColumn('area', 'area_sq_meters');
        $table->renameColumn('transaction_type', 'listing_purpose');
        $table->renameColumn('age', 'age_years');
    });
}

// You can also define the 'down' method to make it reversible
public function down(): void
{
    Schema::table('ads', function (Blueprint $table) {
        $table->dropForeign(['property_type_id']);
        $table->dropForeign(['district_id']);
        $table->dropColumn(['property_type_id', 'district_id']);

        $table->string('property_type')->nullable();
        $table->string('city')->nullable();
        $table->string('neighborhood')->nullable();
        $table->string('province')->nullable();
        $table->string('street')->nullable();
        
        $table->renameColumn('total_price', 'price');
        $table->renameColumn('area_sq_meters', 'area');
        $table->renameColumn('listing_purpose', 'transaction_type');
        $table->renameColumn('age_years', 'age');
    });
}
};
