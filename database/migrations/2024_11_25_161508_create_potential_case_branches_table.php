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
        Schema::create('potential_case_branches', function (Blueprint $table) {
            $table->id();
            $table->decimal('branch_ca', 8, 2); 
            $table->unsignedBigInteger('potencial_case_id');
            $table->unsignedBigInteger('branche_id');
            $table->timestamps();

            $table->foreign('potencial_case_id')->references('id')->on('potencial_cases')->onDelete('cascade');
            $table->foreign('branche_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potential_case_branches');
    }
};
