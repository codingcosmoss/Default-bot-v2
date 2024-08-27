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
        Schema::table('selling_returned_medicines', function (Blueprint $table) {
            $table->integer('batch_id')->nullable()->comment('Partiya id raqami');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selling_returned_medicines', function (Blueprint $table) {
            $table->dropColumn('batch_id');
        });
    }
};
