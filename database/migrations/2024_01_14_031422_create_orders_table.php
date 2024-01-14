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
            $table->id();
            $table->integer('user_id');
            $table->string('user_name', 250);
            $table->string('email', 150)->nullable();
            $table->string('phone_number', 50);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('address', 250);
            $table->string('description', 250)->nullable();
            $table->integer('amount');
            $table->integer('created_by');
            $table->tinyInteger('status');
            $table->tinyInteger('payment_method');
            $table->tinyInteger('payment_status');
            $table->timestamps();
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
