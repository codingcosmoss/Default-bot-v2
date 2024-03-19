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
            $table->id();
            $table->string('name')->nullable();
            $table->string('bar_code')->nullable()->comment('Shtrix codi ');
            $table->string('vendor_code')->nullable()->comment('Sotuvchi codi');
            $table->string('price')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('size_type');
            $table->integer('min_amount')->nullable()->comment('Ishlatilganda shuncha miqdorga yetsa axabar berilsadi');
            $table->softDeletes();
            $table->timestamps();
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
