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
        Schema::table('medicines', function (Blueprint $table) {
            $table->double('percentage', 20, 2)->default(0)->comment('Sotish uchun qoyilgan foiz');
            $table->double('selling_price', 20, 2)->default(0)->comment('Sotish uchun qoyilgan narx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropColumn('percentage');
            $table->dropColumn('selling_price');
        });
    }
};
