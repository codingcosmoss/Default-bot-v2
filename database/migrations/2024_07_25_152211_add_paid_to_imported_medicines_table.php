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
        Schema::table('imported_medicines', function (Blueprint $table) {
            $table->integer('box_size_id')->comment('quti hajmi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('imported_medicines', function (Blueprint $table) {
            $table->dropColumn('box_size_id');
        });
    }
};
