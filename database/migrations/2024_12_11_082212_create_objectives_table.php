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
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->decimal('year_objective', 12, 2); //objectif
            $table->decimal('amount_realized', 12, 2)->default(0); //montant réalisé
            $table->decimal('remaining_amount', 12, 2)->default(0); //montant restant
            $table->year('year')->default(now()->year); 
            $table->enum('objective_status', ['available', 'close'])->default('available');
           
            //commercial
            $table->unsignedBigInteger('commercial_id')->nullable(); //chargé d'affaires
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('commercial_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
