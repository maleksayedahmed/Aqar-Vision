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
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn([
                'rooms',
                'bathrooms',
                'floor_number',
                'finishing_status',
                'facade',
                'is_mortgaged',
                'furniture_status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->integer('rooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('finishing_status')->nullable();
            $table->string('facade')->nullable();
            $table->boolean('is_mortgaged')->default(false);
            $table->string('furniture_status')->nullable();
        });
    }
};