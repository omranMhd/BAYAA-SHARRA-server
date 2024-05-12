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
        Schema::create('farm_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->integer('area')->comment('بالمتر المربع');
            $table->integer('roomCount');
            $table->enum('cladding', ["deluxe", "new", "good", "old", "chassis"])->comment('حالة الإكساء (ديلوكس ,جديدة,جيدة,قديمة,على الهيكل )');
            $table->integer('floorCount')->comment('عدد الطوابق');
            $table->bigInteger('price');
            $table->bigInteger('newPrice');
            $table->string('currency');
            $table->string('molkia');
            $table->enum('sellOrRent', ["sell", "rent"]);
            $table->enum('paymentMethodRent', ["daily", "weekly", "monthly", "yearly"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_filters');
    }
};
