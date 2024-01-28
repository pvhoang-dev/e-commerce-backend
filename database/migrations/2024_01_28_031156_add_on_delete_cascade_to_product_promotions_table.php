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
        Schema::table('product_promotions', function (Blueprint $table) {
            // Xóa khóa ngoại cũ
            $table->dropForeign(['product_variant_id']);

            // Thêm khóa ngoại mới với 'onDelete('cascade')'
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_promotions', function (Blueprint $table) {
            // Xóa khóa ngoại với tên cũ
            $table->dropForeign(['product_variant_id']);

            // Thêm lại khóa ngoại với tên cũ (nếu muốn rollback)
            $table->foreign('product_variant_id')->references('id')->on('product_variants');
        });
    }
};
