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
        Schema::create('common_vehicle_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->string('brand')->nullable()->comment('مثلا kia');
            $table->string('category')->nullable()->comment( 'rioمثلا');
            $table->string('color')->nullable();
            $table->enum('gear', ["normal", "automatic"])->nullable()->comment('ناقل الحركة');
            $table->integer('manufactureYear')->nullable()->comment('سنة الصنع');
            $table->integer('traveledDistance')->nullable()->comment('المسافة المقطوعة بالكيلو متر');
            $table->integer('engineCapacity')->nullable()->comment('سعة المحرك');
            $table->enum('fuel', ["penzen", "diesel", "electricity"])->nullable()->comment('نوع الوقود');
            $table->bigInteger('price')->comment('يمثل سعر في حال البيع او رسوم الأجار في حال الأجار');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->enum('paymentMethodRent', ["daily","weekly","monthly","yearly"])->nullable()->comment('طريقة الدفع في حال الأجار');
            $table->enum('sellOrRent', ["sell", "rent"])->comment('بيع أو أجار');
            $table->enum('paintStatus',["original","repainted"])->nullable()->comment("حالة الطلاء :اساسي و معاد بخها");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_vehicle_filters');
    }
};
