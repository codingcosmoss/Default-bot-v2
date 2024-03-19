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
        Schema::create('product_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('document_category')->nullable();
            $table->foreignId('warehouse_id')->constrained();
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('user_id')->constrained()->comment('Xujjatni rasmilashtirgan xodim id raqami');
            $table->string('description')->nullable();
           $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_documents');
    }
};
