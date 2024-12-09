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
        Schema::create('potencial_case_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('potencial_case_id');
            $table->unsignedBigInteger('service_id');
            $table->json('branch_data')->nullable();
            // $table->json('branch_ids')->nullable();
            // $table->json('branch_amounts')->nullable();
            $table->timestamps();

            $table->foreign('potencial_case_id')->references('id')->on('potencial_cases')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potencial_case_service');
    }
};
