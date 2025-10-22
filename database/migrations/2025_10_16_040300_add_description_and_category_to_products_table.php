<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('products')) return;

        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom 'brand' jika belum ada (aman kalau sudah ada -> di-skip)
            if (!Schema::hasColumn('products', 'brand')) {
                $table->string('brand', 100)->nullable();
            }

            // Tambah kolom 'category' (string) untuk kompatibilitas laporan/UI lama
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category', 100)->nullable()->index();
            }

            // Tambah kolom 'description'
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('products')) return;

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'description')) {
                $table->dropColumn('description');
            }
            // Hapus dua baris di bawah kalau kamu memang ingin tetap menyimpan 'brand' & 'category'
            // if (Schema::hasColumn('products', 'brand')) {
            //     $table->dropColumn('brand');
            // }
            // if (Schema::hasColumn('products', 'category')) {
            //     $table->dropColumn('category');
            // }
        });
    }
};
