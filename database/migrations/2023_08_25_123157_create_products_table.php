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
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('product_id', 12)
                ->unsigned()
                ->primary();
            $table->string('product_category');
            $table->string('product_type');
            $table->json('product_nameL_list');
            $table->json('product_brand_list');
            $table->enum('product_status', ['delete', 'delist', 'public'])
            ->default('public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
