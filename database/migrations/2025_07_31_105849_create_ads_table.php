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

            // --- Step 1 Data ---
            
            // Basic Info
            $table->string('title');
            $table->string('age')->nullable();
            $table->string('transaction_type');
            $table->string('floor_number')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('finishing_status');
            $table->string('property_type');
            $table->string('direction')->nullable();
            $table->unsignedInteger('bathrooms');
            $table->unsignedInteger('rooms');
            $table->decimal('area', 10, 2);
            $table->text('description')->nullable();

            // Location Info
            $table->string('city');
            $table->string('neighborhood');
            $table->string('province');
            $table->string('street');

            // Features (stored as a JSON array)
            $table->json('features')->nullable();

            // Additional Details
            $table->string('usage')->nullable();
            $table->string('plan_number')->nullable();
            $table->string('mortgaged')->nullable();
            $table->string('furniture')->nullable();
            $table->string('build_status')->nullable();
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();

            // --- Step 2 Data ---

            // Media (simple path storage)
            $table->string('video_path', 2048)->nullable();
            $table->json('images')->nullable();

            // Status & Timestamps
            $table->string('status')->default('pending');
            $table->timestamp('expires_at')->nullable();
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