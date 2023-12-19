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
        Schema::create('file_drafts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string('name', 255);
            $table->string('path', 255);
            $table->string('mime_type', 255);
            $table->integer('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_drafts');
    }
};
