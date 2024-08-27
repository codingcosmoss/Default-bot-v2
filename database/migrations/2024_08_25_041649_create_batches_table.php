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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('medicine_id');
            $table->integer('imported_medicine_id')->nullable();
            $table->integer('document_id');
            $table->string('name');
            $table->integer('amount');
            $table->date('expiry_date_finished');
            $table->integer('is_expiration')->default(\App\Traits\Status::$status_active);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
