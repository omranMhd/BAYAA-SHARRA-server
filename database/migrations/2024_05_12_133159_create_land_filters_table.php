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
        Schema::create('land_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->integer('area')->nullable()->comment('بالمتر المربع');
            $table->bigInteger('price');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->string('molkia')->nullable();
            $table->enum('sellOrRent', ["sell", "rent"]);
            $table->enum('paymentMethodRent', ["daily", "weekly", "monthly", "yearly"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_filters');
    }
};
