<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'ads' table with all necessary columns
     * to store advertisement information.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();

            // Foreign key to link the ad to the user who created it.
            // If the user is deleted, all their ads are also deleted.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Foreign key to link to the type of ad package purchased (e.g., "Featured Ad").
            // If the AdPrice record is deleted, this value becomes null, but the ad remains.
            $table->foreignId('ad_price_id')->nullable()->constrained()->onDelete('set null');

            // Core details of the property advertisement
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('property_type')->nullable(); // e.g., 'Villa', 'Apartment', 'Land'

            // Status of the ad to manage its lifecycle
            $table->enum('status', ['active', 'pending', 'expired', 'rejected', 'deleted'])->default('pending');
            
            // The date and time when the ad will no longer be active.
            $table->timestamp('expires_at')->nullable(); 
            
            // Standard timestamps for creation and updates.
            $table->timestamps(); 
            
            // Enables soft deleting for the "deleted" tab functionality.
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method ensures that the table can be safely dropped if a rollback is needed.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};