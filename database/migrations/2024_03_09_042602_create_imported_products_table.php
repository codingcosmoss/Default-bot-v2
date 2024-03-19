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
        Schema::create('imported_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_document_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->integer('amount')->comment('Mahsulotning olib kelingan miqdori');
            $table->integer('price')->comment('Mahsulotning olib kelingan narxi');
            $table->integer('status')->default(\App\Traits\Status::$status_active);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imported_products');
    }
};
