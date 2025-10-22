<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedInteger('quantity');                 // jumlah terjual
            $table->decimal('unit_price', 15, 2)->default(0);   // harga satuan saat transaksi
            $table->decimal('total_price', 15, 2)->default(0);  // unit_price * quantity
            $table->string('customer_name')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('sold_at')->useCurrent();         // waktu transaksi
            $table->timestamps();

            $table->index('sold_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
