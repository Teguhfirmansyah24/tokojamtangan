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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Big Integer Auto Increment Primary Key

            // relasi ke categories
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            // informasi dasar
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // harga
            $table->decimal('price', 12, 2);
            $table->decimal('discount_price', 12, 2)->nullable();

            // stok barang
            $table->integer('stock')->default(0);

            // berat barang
            $table->integer('weight')->default(0)->comment('dalam gram');

            // status visibilitas
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            // Index membuat pencarian JAUH lebih cepat.
            $table->index('category_id', 'is_active');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
