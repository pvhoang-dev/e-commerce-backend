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
            $table->integer("qty");
            $table->decimal("plv_1");
            $table->decimal("plv_2");
            $table->decimal("plv_3");
            $table->string("short_description", 500)->nullable();
            $table->unsignedBigInteger("category_id");

            $table->foreign('category_id')->references('id')->on('categories');
            $table->tinyInteger("status")->index("idx_products_status");
            $table->timestamps();
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
