<?php

use Illuminate\Database\Migrations\Migration; // <-- THIS LINE IS NOW CORRECT
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Adding all the new fields from your HTML
            $table->string('floor_number')->nullable()->after('age_years');
            $table->string('finishing_status')->nullable()->after('floor_number');
            $table->string('street_name')->nullable()->after('district_id');
            $table->string('province')->nullable()->after('district_id');
            $table->string('property_usage')->nullable()->after('services');
            $table->boolean('is_mortgaged')->default(false)->after('property_usage');
            $table->string('building_status')->nullable()->after('is_mortgaged');
            $table->string('plan_number')->nullable()->after('building_status');
            $table->string('furniture_status')->nullable()->after('plan_number');
            $table->string('building_number')->nullable()->after('furniture_status');
            $table->string('postal_code')->nullable()->after('building_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'floor_number',
                'finishing_status',
                'street_name',
                'province',
                'property_usage',
                'is_mortgaged',
                'building_status',
                'plan_number',
                'furniture_status',
                'building_number',
                'postal_code'
            ]);
        });
    }
};