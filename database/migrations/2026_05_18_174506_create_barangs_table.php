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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->integer('stok');
            $table->integer('harga');
            
            // The requirement asks for a string. If you want to strictly limit the inputs later, 
            // you can enforce the 'Baik', 'Rusak Ringan', 'Rusak Berat' choices at the Filament form level.
            $table->string('kondisi'); 
            
            $table->string('lokasi'); // e.g., Gudang A, Gudang B
            
            $table->text('deskripsi')->nullable();
            $table->text('image')->nullable();
            
            // Foreign key linking to the default users table
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
