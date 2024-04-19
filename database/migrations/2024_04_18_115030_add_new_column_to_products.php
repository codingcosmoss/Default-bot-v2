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
            $table->integer('brand_id');
            $table->string('tegs');
            $table->text('description_uz');
            $table->text('description_ru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('brand_id');
            $table->dropColumn('tegs');
            $table->dropColumn('description_uz');
            $table->dropColumn('description_ru');
        });
    }
};
