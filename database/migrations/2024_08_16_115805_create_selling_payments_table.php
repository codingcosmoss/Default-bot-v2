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
        Schema::create('selling_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('customer_id')->comment('Xaridor');
            $table->integer('user_id')->comment('Sotuvchi');
            $table->integer('payment_type_id')->comment('Tolov turi');
            $table->integer('invoice_id')->comment('Hisob faktura');
            $table->integer('amount')->default(0)->comment('Jami miqdori');
            $table->integer('currency_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_payments');
    }
};
