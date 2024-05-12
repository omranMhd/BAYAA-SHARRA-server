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
            $table->string('brand')->comment('مثلا kia');
            $table->string('category')->comment( 'rioمثلا');
            $table->string('color');
            $table->enum('gear', ["normal", "automatic"])->comment('ناقل الحركة');
            $table->integer('manufactureYear')->comment('سنة الصنع');
            $table->integer('traveledDistance')->comment('المسافة المقطوعة بالكيلو متر');
            $table->integer('engineCapacity')->comment('سعة المحرك');
            $table->enum('fuel', ["penzen", "diesel", "electricity"])->comment('نوع الوقود');
            $table->bigInteger('price')->comment('يمثل سعر في حال البيع او رسوم الأجار في حال الأجار');
            $table->bigInteger('newPrice');
            $table->string('currency');
            $table->enum('paymentMethodRent', ["daily","weekly","monthly","yearly"])->comment('طريقة الدفع في حال الأجار');
            $table->enum('sellOrRent', ["sell", "rent"])->comment('بيع أو أجار');
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
