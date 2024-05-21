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
        Schema::create('vella_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->integer('area')->nullable()->comment('بالمتر المربع');
            $table->integer('roomCount')->nullable();
            $table->enum('cladding', ["deluxe", "new", "good", "old", "chassis"])->nullable()->comment('حالة الإكساء (ديلوكس ,جديدة,جيدة,قديمة,على الهيكل )');
            $table->integer('floorsCount')->nullable()->comment('عدد الطوابق');
            $table->bigInteger('price');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->string('ownership')->nullable()->comment('نوع وثيقة الملكية');
            $table->enum('sellOrRent', ["sell", "rent"]);
            $table->enum('paymentMethodRent', ["daily", "weekly", "monthly", "yearly"])->nullable();
            $table->enum('direction', ['north', 'south', 'west', 'east', 'north-east', 'north-west', 'south-east', 'south-west'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vella_filters');
    }
};
