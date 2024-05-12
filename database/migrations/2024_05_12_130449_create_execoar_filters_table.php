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
        Schema::create('execoar_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->bigInteger('price');
            $table->bigInteger('newPrice');
            $table->string('currency');
            $table->string('deviceType')->comment('نوع الجهاز يلي بتصلح الو هي القطعة وهي اما موبايل او تاب او كومبيوتر');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('execoar_filters');
    }
};
