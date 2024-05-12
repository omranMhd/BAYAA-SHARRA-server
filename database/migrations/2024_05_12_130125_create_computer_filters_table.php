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
            $table->bigInteger('newPrice');
            $table->string('currency');
            $table->string('brand')->comment('مثلا HP');
            $table->string('category')->comment('مثلا victus');
            $table->integer('ram');
            $table->integer('hard');
            $table->string('processor');
            $table->enum('status', ["old", "new"])->comment('جديد او مستعمل');
            $table->enum('screenType', ["touch", "normal"])->comment('لمس او عادي');
            $table->integer('screenSize')->comment('قياس الشاشة');
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
