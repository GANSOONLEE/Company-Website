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
        Schema::create('approve_users', function (Blueprint $table) {
            $table->id();
            $table->string('email_address');
            $table->timestamps();

            /**
             *  foreign column 
             */
            
            $table->foreign('email_address')
            ->references('email_address')
            ->on('users');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approve_users');
    }
};
