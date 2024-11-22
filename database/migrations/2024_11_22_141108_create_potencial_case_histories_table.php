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
        Schema::create('potencial_case_histories', function (Blueprint $table) {
            $table->id();
        
            $table->string('statut_precedent')->default('pending');
            $table->string('statut_nouveau')->nullable()->default('pending');
            $table->timestamp('change_date');
            $table->text('commentaire');
            $table->unsignedBigInteger('potencial_case_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('potencial_case_id')->references('id')->on('potencial_cases')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potencial_case_histories');
    }
};
