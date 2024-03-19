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
        Schema::create('owed_treatments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->comment('Ruxsat bergan shaxs');
            $table->string('authorizing')->comment('Qarzga kim ruxsat berildi');
            $table->date('return_at')->comment('Qaytarish vaqti');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('treatment_id')->constrained();
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owed_treatments');
    }
};
