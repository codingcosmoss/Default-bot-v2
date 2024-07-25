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
        Schema::create('remaining_drugs', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('medicine_id');
            $table->integer('amount')->comment('Qolgan miqdori');
            $table->integer('model_id')->comment('Imported_products yoki sold_products idsi')->nullable();
            $table->integer('type')->default(\App\Traits\Status::$import)->comment("miqdorni o'zgartirgan omil");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remaining_drugs');
    }
};
