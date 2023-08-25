<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->string('username');
        $table->string('role');
        $table->string('phone_number')->nullable();
        $table->string('email_address')->unique();
        $table->date('birthday')->nullable();
        $table->string('address')->nullable();
        $table->string('profession')->nullable();
        $table->string('company_name')->nullable();
        $table->string('password');
        $table->string('access_token')->nullable();
        $table->timestamp('email_verified_at')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
