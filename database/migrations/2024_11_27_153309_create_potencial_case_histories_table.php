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
            $table->text('comment')->nullable();
            $table->enum('action_type', ['created', 'updated', 'appointment_added', 'report_added', 'status_changed', 'note_added', 'other']); 
            $table->timestamp('action_date'); 
            $table->unsignedBigInteger('potencial_case_id')->nullable(); 
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('report_id')->nullable();
            $table->unsignedBigInteger('created_by'); 
            $table->timestamps();
        
            $table->foreign('potencial_case_id')->references('id')->on('potencial_cases')->onDelete('cascade');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
