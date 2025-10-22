<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->enum('type', ['in','out']);                 // in = tambah, out = kurang
            $table->unsignedInteger('quantity');
            $table->string('reason')->nullable();               // alasan (text bebas)
            $table->text('note')->nullable();
            $table->unsignedInteger('before_stock')->default(0);
            $table->unsignedInteger('after_stock')->default(0);
            $table->timestamp('moved_at')->useCurrent();
            $table->timestamps();

            $table->index(['product_id', 'moved_at']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
