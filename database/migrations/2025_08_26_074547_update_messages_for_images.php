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
        Schema::table('messages', function (Blueprint $table) {
            // Add a column to store the path to the uploaded image. It's nullable.
            $table->string('image_path')->nullable()->after('body');

            // Make the body nullable, as a message might only contain an image.
            $table->text('body')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('image_path');
            $table->text('body')->nullable(false)->change();
        });
    }
};