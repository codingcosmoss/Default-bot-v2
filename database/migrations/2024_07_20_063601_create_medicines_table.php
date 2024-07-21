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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('clinic_id');
            $table->integer('medicine_category_id')->nullable();
            $table->integer('box_size_id')->nullable();
            $table->integer('size_type_id')->nullable()->comment("O'lchov birligi");
            $table->integer('drug_company_id')->nullable()->comment('Dori ishlab chiqarish firmasi');
            $table->string('qr_code')->nullable();
            $table->string('hns_code')->nullable();
            $table->string('name')->nullable();
            $table->string('desc')->nullable();
            $table->integer('strength')->nullable()->comment('Dorining kuchi yoki konsentratsiyasini bildiradi');
            $table->string('generic_name')->nullable();
            $table->string('shelf')->nullable()->comment('Dorining saqlanish joyi');
            $table->double('price', 20, 2)->nullable()->comment('Sotish narxi');
            $table->double('buy_price', 20, 2)->nullable()->comment('sotib olish narxi');
            $table->double('vat', 20, 2)->default(0)->comment('mahsulot yoki xizmat soligi');
            $table->double('igta', 20, 2)->default(0)->comment('import bojlari yoki soliqlari');
            $table->integer('status')->default(\App\Traits\Status::$status_active);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
