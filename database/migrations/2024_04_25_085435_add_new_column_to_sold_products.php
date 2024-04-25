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
        Schema::table('sold_products', function (Blueprint $table) {
            $table->integer('api_user_id');
            $table->integer('price');
            $table->integer('result_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sold_products', function (Blueprint $table) {
            $table->dropColumn('api_user_id');
        });
    }
};
