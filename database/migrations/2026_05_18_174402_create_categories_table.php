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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            
            // Note: I added nullable() here. It is a good practice to allow these to be empty 
            // initially in case a user creates a category but doesn't have an image or description ready yet.
            // If the strict requirement is that they MUST be filled, you can simply delete '->nullable()'.
            $table->text('deskripsi')->nullable();
            $table->text('image')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
