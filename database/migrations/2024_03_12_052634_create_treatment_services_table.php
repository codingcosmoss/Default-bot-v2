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
        Schema::create('treatment_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->integer('amount')->nullable();
            $table->integer('status')->default(\App\Traits\Status::$status_active);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_services');
    }
};
