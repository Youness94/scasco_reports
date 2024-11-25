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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_first_name');
            $table->string('client_last_name');
            $table->string('client_address');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('raison_sociale')->nullable();
            $table->string('RC')->nullable(); // RC: Registre du Commerce
            $table->string('ICE')->nullable(); // ICE: Identifiant Commun de l'Entreprise
            $table->enum('client_type', ['Entreprise', 'Particulier'])->default('Particulier');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
