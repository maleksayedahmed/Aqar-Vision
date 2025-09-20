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
        Schema::create('agency_upgrade_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upgrade_request_id')->constrained()->onDelete('cascade');
            $table->string('agency_name');
            $table->unsignedBigInteger('agency_type_id');
            $table->string('commercial_register_number')->nullable();
            $table->date('commercial_issue_date')->nullable();
            $table->date('commercial_expiry_date')->nullable();
            $table->string('tax_id')->nullable();
            $table->date('tax_issue_date')->nullable();
            $table->date('tax_expiry_date')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('accreditation_status')->nullable();
            $table->timestamps();

            $table->foreign('agency_type_id')->references('id')->on('agency_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_upgrade_requests');
    }
};
