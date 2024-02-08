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
            $table->string('position')->nullable()->comment('lavozimi');
            $table->string('profil_photo_path', 500)->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('status')->default(\App\Traits\Status::$status_active);
            $table->string('percent_salary')->nullable()->comment('foiz ish haqqi');
            $table->string('salary_static')->nullable()->comment('statik ish haqqi');
            $table->integer('sort_order')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
