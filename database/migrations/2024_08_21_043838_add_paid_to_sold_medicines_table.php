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
            $table->double('one_sum', 20, 2)->default(0)->comment('bitta dorining vat + gst + price narxi');
            $table->double('result_sum', 20, 2)->default(0)->comment('Barcha dorining vat + gst + price narxi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sold_medicines', function (Blueprint $table) {
            $table->dropColumn('one_sum');
            $table->dropColumn('result_sum');
        });
    }
};
