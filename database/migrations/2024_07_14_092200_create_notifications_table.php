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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Xabar nomi')->nullable();
            $table->string('desc')->comment('Izoh')->nullable();
            $table->integer('type')->comment('Xabar turi');
            $table->integer('model_id')->nullable();
            $table->string('clinic_id');
            $table->integer('user_id')->comment('foydalanuvchi idsi')->default(0);
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
