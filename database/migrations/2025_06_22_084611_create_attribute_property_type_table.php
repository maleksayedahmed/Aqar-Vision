<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attribute_property_type', function (Blueprint $table) {
            $table->foreignId('property_attribute_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->primary(['property_attribute_id', 'property_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attribute_property_type');
    }
};