<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->decimal('street_width', 5, 2)->nullable();
            $table->string('facade')->nullable();
            $table->decimal('area_sq_meters', 10, 2)->nullable();
            $table->unsignedBigInteger('purpose_id')->nullable();
            $table->decimal('price_per_unit', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->integer('age_years')->nullable();
            $table->json('services')->nullable();
            $table->enum('listing_purpose', ['sale', 'rent'])->nullable();
            $table->string('contact_number')->nullable();
            $table->text('encumbrances')->nullable();
            $table->enum('status', ['available', 'sold', 'rented'])->default('available');
            $table->date('list_date')->nullable();
            $table->date('sold_rented_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('purpose_id')->references('id')->on('property_purposes')->onDelete('restrict');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}; 