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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigInteger('order_id', false, true)
                ->primary();
            $table->string('email_address');
            $table->date('order_received_date');
            $table->date('order_received_time');
            $table->json('order_content');
            $table->enum('order_status',['New', 'Pending', 'Processing', 'On Hold', 'Completed'])
                ->default('New');
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
        Schema::dropIfExists('orders');
    }
};
