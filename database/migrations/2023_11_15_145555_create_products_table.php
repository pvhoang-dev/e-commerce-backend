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
            $table->id();
            $table->string("name");
            $table->string("slug", 250)->unique();
            $table->string("sku", 50)->unique();
            $table->unsignedBigInteger("category_id")->default(0);
            $table->integer("price");
            $table->integer("promotion_price")->default(0);
            $table->integer("product_promotion_id")->default(0);
            $table->integer("qty")->default(0);
            $table->string("short_description", 500)->nullable();
            $table->tinyInteger("status")->index("idx_products_status");
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
