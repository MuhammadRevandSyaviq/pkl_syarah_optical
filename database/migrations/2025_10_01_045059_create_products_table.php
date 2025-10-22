<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID unik produk
            $table->string('name'); // Nama produk
            $table->string('sku')->unique(); // Stock Keeping Unit (kode produk), harus unik
            $table->string('category')->nullable(); // Kategori produk (contoh: Makanan, Elektronik)
            $table->integer('stock_quantity')->default(0); // Jumlah stok saat ini
            $table->decimal('price', 10, 2)->default(0.00); // Harga jual
            $table->timestamps(); // Created at dan Updated at
        });
    }

    /**
     * Batalkan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};