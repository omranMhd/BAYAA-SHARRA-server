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
        Schema::create('computer_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->bigInteger('price');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->string('brand')->comment('مثلا HP')->nullable();
            $table->string('category')->comment('مثلا victus')->nullable();
            $table->integer('ram')->nullable();
            $table->integer('hard')->nullable();
            $table->string('processor')->nullable();
            $table->enum('status', ["old", "new"])->comment('جديد او مستعمل')->nullable();
            $table->enum('screenType', ["touch", "normal"])->nullable()->comment('لمس او عادي');
            $table->integer('screenSize')->nullable()->comment('قياس الشاشة');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computer_filters');
    }
};
