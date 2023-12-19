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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->string("name", 250);
            $table->string("slug", 250)->unique();
            $table->string("sku", 50)->unique();
            $table->integer("qty");
            $table->decimal("plv_1");
            $table->decimal("plv_2");
            $table->decimal("plv_3");
            $table->tinyInteger("status")->index("idx_product_variants_status");
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
