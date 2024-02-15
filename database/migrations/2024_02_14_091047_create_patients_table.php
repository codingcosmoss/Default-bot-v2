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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->integer('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('price')->nullable();
            $table->string('profil_photo_path')->nullable();
            $table->integer('diseases_id')->nullable();
            $table->integer('status')->default(\App\Traits\Status::$status_active);
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
