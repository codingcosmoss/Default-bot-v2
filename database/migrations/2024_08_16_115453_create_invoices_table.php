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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('customer_id')->comment('Xaridor');
            $table->integer('user_id')->comment('Sotuvchi');
            $table->date('date')->comment('Sana');
            $table->integer('amount')->comment('Umumiy miqdori')->default(0);
            $table->double('amount_paid', 20, 2)->comment("To'langan miqdori")->default(0);
            $table->double('must_paid', 20, 2)->comment("To'lanishi kerak")->default(0);
            $table->double('subtotal', 20, 2)->comment('Jami summa')->default(0);
            $table->double('igta', 20, 2)->default(0);
            $table->double('gst', 20, 2)->default(0);
            $table->integer('currency_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
