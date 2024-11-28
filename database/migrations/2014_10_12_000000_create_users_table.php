<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phonenumber')->unique()->nullable();
            $table->string('status')->nullable()->default('Active');
            $table->enum('user_type', ['Admin', 'Responsable', 'Super Responsable', 'Commercial'])->default('Commercial');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('responsible_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('reset_password_token')->nullable();
            $table->timestamp('reset_password_token_expiry')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
        // User::create(['name' => 'admin','email' => 'admin@themesbrand.com','password' => Hash::make('12345678'),'email_verified_at'=>'2022-01-02 17:04:58','avatar' => 'avatar-1.jpg','created_at' => now(),]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
