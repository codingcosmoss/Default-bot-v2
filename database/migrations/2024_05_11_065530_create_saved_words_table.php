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
        Schema::create('saved_words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained();
            $table->text('text');
            $table->integer('status')->default(1)->comment('Status 1 saqlanmagan boladi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_words');
    }
};
