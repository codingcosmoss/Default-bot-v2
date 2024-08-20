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
        Schema::table('sold_medicines', function (Blueprint $table) {
            $table->double('igta', 20, 2)->nullable();
            $table->double('gst', 20, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sold_medicines', function (Blueprint $table) {
            $table->dropColumn('igta');
            $table->dropColumn('gst');
        });
    }
};
