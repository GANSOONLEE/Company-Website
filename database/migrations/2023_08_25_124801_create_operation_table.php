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
        Schema::create('operation', function (Blueprint $table) {
            $table->id('operation_id');
            $table->string('email_address');
            $table->json('operation_data');
            $table->enum('operation_type',['create product', 'update product', 'delete product', 'change role']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation');
    }
};
