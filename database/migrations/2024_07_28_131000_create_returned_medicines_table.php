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
        Schema::create('returned_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('document_id');
            $table->integer('supplier_id');
            $table->integer('warehouse_id');
            $table->integer('medicine_id');
            $table->integer('box_size_id');
            $table->integer('amount')->default(0)->comment('Qaytarilgan dori miqdori');
            $table->double('buy_price', 20 ,2)->default(0)->comment('Sotib olish narxi');
            $table->double('total_cost', 20, 2)->default(0)->comment('Jami sotib olingan narxi');
            $table->date('expiry_date_finished')->nullable()->comment('Yaroqlilik muddatining tugashi');
            $table->integer('currency_id')->comment('Savdo qilingan valyuta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returned_medicines');
    }
};
