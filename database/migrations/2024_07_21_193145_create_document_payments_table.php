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
        Schema::create('document_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('document_id');
            $table->integer('supplier_id');
            $table->integer('user_id');
            $table->double('amount', 20, 2)->comment('Tolangan miqdori');
            $table->integer('payment_type_id')->comment('Tolov turi');
            $table->integer('currency_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_payments');
    }
};
