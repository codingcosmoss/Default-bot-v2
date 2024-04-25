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
        Schema::table('products', function (Blueprint $table) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('brand_id')->nullable()->change();
                $table->string('tegs')->nullable()->change();
                $table->text('description_uz')->nullable()->change();
                $table->text('description_ru')->nullable()->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('brand_id')->nullable(false)->change();
                $table->string('tegs')->nullable(false)->change();
                $table->text('description_uz')->nullable(false)->change();
                $table->text('description_ru')->nullable(false)->change();
            });
        });
    }
};
