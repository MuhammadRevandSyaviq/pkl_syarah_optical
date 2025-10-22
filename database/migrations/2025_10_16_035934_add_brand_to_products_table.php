<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('products')) return;

        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom brand jika belum ada
            if (!Schema::hasColumn('products', 'brand')) {
                // letakkan setelah category_id (atau sesuaikan posisi yang kamu mau)
                $table->string('brand', 100)->nullable()->after('category_id');
            }

            // (opsional – untuk kompatibilitas kalau kolom 'category' string belum ada)
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category', 100)->nullable()->after('brand');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('products')) return;

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'brand')) {
                $table->dropColumn('brand');
            }
            // hapus ini kalau kamu memang butuh kolom 'category' string
            // if (Schema::hasColumn('products', 'category')) {
            //     $table->dropColumn('category');
            // }
        });
    }
};
