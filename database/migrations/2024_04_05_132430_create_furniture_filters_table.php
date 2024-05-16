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
        Schema::create('furniture_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->bigInteger('price');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->enum('status', ["old", "new"])->nullable();
            $table->enum('material', ["wood", "metal", "leather", "plastic"])->nullable()->comment("مادة الصنع :خشب,معدن,جلد,بلاستك");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_filters');
    }
};
