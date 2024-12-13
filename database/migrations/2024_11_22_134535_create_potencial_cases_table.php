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
        Schema::create('potencial_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number');
            $table->enum('case_status', ['pending', 'completed', 'processing', 'cancelled'])->default('pending');
            $table->string('case_name');
            $table->decimal('case_capital', 8, 2)->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null'); 
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potencial_cases');
    }
};
