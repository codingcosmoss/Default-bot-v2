<?php

use App\Traits\Status;
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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Doctor id raqami');
            $table->foreignId('patient_id')->constrained()->comment('Bemor id raqami');
            $table->string('reception_description')->nullable()->comment('qabul qilish tavsifi');
            $table->string('start')->nullable()->comment('Davolanishni boshlash vaqti');
            $table->string('end')->nullable()->comment('Davolanishni tugatgan vaqt');
            $table->double('price')->nullable();
            $table->integer('status')->default(Status::$status_active);
            $table->double('doctor_percent_total_amount', 20, 2)->nullable();
            $table->double('discount_percent')->default(0)->comment('Chegrima miqdori foizda');
            $table->double('discount_sum', 20, 2)->default(0)->comment('Chegirma miqdori sumda');
            $table->double('discount_total_sum', 20, 2)->default(0)->comment('Chegirmani umumiy summasi');
            $table->double('service_real_price', 20, 2)->nullable()->comment('Xizmat narxi');
            $table->integer('type_of_discount')->nullable()->comment('Chegirma kim tomonidan berilgani (Klinika/Doktor)');
            $table->integer('loan_type_by')->nullable()->comment('Qarzga kim ruxsat berilganligi (Klinika/Doktor)	');
            $table->text('loan_type_comment')->nullable()->comment('Qarzga bajarishga ruxsat berilish sababi');
            $table->integer('payment_type')->nullable()->comment("Bemorni to'lagan to'lov turi");
            $table->integer('user_payment')->nullable()->comment("Bemorni to'lagan pul miqdori");
            $table->integer('payment_status')->nullable()->comment("Bemorni davolash uchun to'lagan to'lovini holati:(0-To'lanmadi,1-To'liq to'lanmadi, 2-Yopildi)");
            $table->double('clinic_percent_total_amount', 20, 2)->nullable()->comment("Klinika oladigan ulushni umumiy qiymati");
            $table->double('discount_by_doctor_total_sum', 20, 2)->nullable()->comment("Chegirma (Shifokor yoki umumiy) tomonidan berilsa o'shani natijaviy summasi");
            $table->double('discount_by_clinic_total_sum', 20,2)->nullable()->comment("Chegirma (Kasalxona yoki umumiy) tomonidan berilsa o'shani natijaviy summasi");
            $table->double('doctor_result_sum', 20, 2)->nullable()->comment("Doktor ulushining natijaviy summasi");
            $table->double('clinic_result_sum', 20, 2)->nullable()->comment("Klinika ulushining natijaviy summasi");
            $table->integer('is_give_money_doctor')->nullable()->comment("Doktor davolash uchun pulni qabul qildimi?");
            $table->dateTime('doctor_givey_money_at')->nullable()->comment("Doktor davolash uchun pulni olgan sana");
            $table->integer('is_give_money_technic')->nullable()->comment("Texnik davolash uchun pul oldimi?  ");
            $table->dateTime('give_money_technic_at')->nullable()->comment("Texnik davolash uchun pulni olgan sanasi  ");
            $table->integer('technic_id')->nullable()->comment("Texnik ID raqami  ");
            $table->dateTime('debt_deadline')->nullable()->comment("Qarzni qaytarish sanasi ");
            $table->double('total_technic_sum', 20,2)->nullable()->comment("Texnik umumiy summasi  ");
            $table->dateTime('payment_date')->nullable()->comment("	Mijozni oxirgi pul bergan sanasi  ");
            $table->integer('doctor_percent_salary')->nullable()->comment("Doktor ulushi");
            $table->integer('technic_or_doctor_payment_type')->default(Status::$cash)->comment("Doktor yoki texnikka berilgan pul turi");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
