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
        Schema::create('output_words', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment("Foydalanuvchi idsi");
            $table->integer('incoming_word_id')->comment("Kiruvchi so'z idsi");
            $table->integer('outgoing_word_id')->comment("Chiquvchi so'z idsi");
            $table->integer('weight')->comment("Chiqish vazni")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output_words');
    }
};
