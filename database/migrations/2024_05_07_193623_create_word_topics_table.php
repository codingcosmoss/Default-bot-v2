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
        Schema::create('word_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->constrained();
            $table->foreignId('topic_id')->constrained();
            $table->integer('percent')->default(0)->comment("So'zni ushbu mavzuga necha foiz taluqliligi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_topics');
    }
};
