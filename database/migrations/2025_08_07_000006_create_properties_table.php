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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            // REPLACED 'city' and 'neighborhood' with 'district_id'
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');

            $table->decimal('street_width', 5, 2)->nullable();
            $table->string('facade')->nullable();
            $table->decimal('area_sq_meters', 10, 2)->nullable();
            $table->decimal('price_per_unit', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->integer('age_years')->nullable();
            $table->json('services')->nullable();
            $table->enum('listing_purpose', ['sale', 'rent'])->nullable();
            $table->string('contact_number')->nullable();
            $table->text('encumbrances')->nullable();
            $table->enum('status', ['available', 'sold', 'rented'])->default('available');
            $table->date('list_date')->nullable();
            $table->date('sold_rented_date')->nullable();

            // Foreign Keys using the modern, chained method
            $table->foreignId('purpose_id')->nullable()->constrained('property_purposes')->onDelete('set null');
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};