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
        Schema::table('words', function (Blueprint $table) {
            $table->integer('answer_user_id')->nullable()->comment("Savolga javob berish orqali kiritilgan so'zni javob bergan foydalanuvchi idsi");
            $table->integer('question_word_id')->nullable()->comment("Savol sifatida berilgan berilgan so'z idsi");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn('answer_user_id');
            $table->dropColumn('question_word_id');
        });
    }
};
