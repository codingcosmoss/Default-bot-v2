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
        Schema::table('treatment_services', function (Blueprint $table) {
            $table->double('result_price', 20, 2)->default(0);
            $table->string('service_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treatment_services', function (Blueprint $table) {
            $table->dropColumn('result_price');
            $table->dropColumn('service_name');
        });
    }
};
