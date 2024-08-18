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
        Schema::create('sold_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->string('name')->comment('Dori nomi')->nullable();
            $table->integer('customer_id')->comment('Xaridor');
            $table->integer('medicine_id')->comment('Dori');
            $table->integer('user_id')->comment('Sotuvchi');
            $table->integer('invoice_id')->comment('Hisob faktura');
            $table->integer('amount')->default(0)->comment('Miqdori');
            $table->double('price', 20, 2)->default(0)->comment('Dori narxi');
            $table->double('subtotal', 20, 2)->default(0)->comment('Dori jami narxi');
            $table->integer('currency_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sold_medicines');
    }
};
