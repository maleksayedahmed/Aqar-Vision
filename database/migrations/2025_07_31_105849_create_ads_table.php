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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ad_price_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');

            // Ad Status
            $table->string('status')->default('pending');
            $table->timestamp('expires_at')->nullable();

            // Property Details
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('listing_purpose', ['sale', 'rent']);
            $table->decimal('total_price', 15, 2);
            $table->decimal('area_sq_meters', 10, 2);
            $table->integer('age_years')->nullable();
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->string('floor_number')->nullable();
            $table->string('finishing_status')->nullable();
            $table->string('facade')->nullable();

            // Location Details
            $table->string('province')->nullable();
            $table->string('street_name')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Features & Additional Details
            $table->json('features')->nullable();
            $table->string('property_usage')->nullable();
            $table->string('plan_number')->nullable();
            $table->boolean('is_mortgaged')->default(false);
            $table->string('furniture_status')->nullable();
            $table->string('building_status')->nullable();
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();

            // Media Paths
            $table->string('video_path')->nullable();
            $table->json('images')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};