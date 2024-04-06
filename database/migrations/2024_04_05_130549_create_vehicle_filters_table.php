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
        Schema::create('vehicle_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->enum('oldOrNew', ["old","new"]);
            $table->integer('traveledDistance')->comment('قديش ماشية المركبة');
            $table->enum('sellOrRent', ["sell","rent"]);
            $table->enum('fuelType', ["benzene","diesel","gas","electricity"])->comment('نوع الوقود');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_filters');
    }
};
