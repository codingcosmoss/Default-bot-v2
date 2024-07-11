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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('login')->nullable()->unique();
            $table->string('password')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('clinic_id')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->tinyInteger('status')->default(\App\Traits\Status::$status_active);
            $table->integer('management')->default(\App\Traits\Status::$admin_panel);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
