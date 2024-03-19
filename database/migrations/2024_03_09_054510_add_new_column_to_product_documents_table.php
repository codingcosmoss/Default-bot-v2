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
        Schema::table('product_documents', function (Blueprint $table) {
            $table->integer('status')->default(\App\Traits\Status::$notSaved);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_documents', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
