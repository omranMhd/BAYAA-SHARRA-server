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
        Schema::create('mob_tab_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->bigInteger('price');
            $table->bigInteger('newPrice')->nullable();
            $table->string('currency');
            $table->string('brand')->comment('مثلا شاومي')->nullable();
            $table->string('category')->comment('مثلا note 11 pro')->nullable();
            $table->integer('ram')->comment('سعة الرام بواحدة الغيغا')->nullable();
            $table->integer('hard')->comment('سعة الهارد بواحدة الغيغا')->nullable();
            $table->enum('status', ["old", "new"])->comment('جديد او مستعمل')->nullable();
            $table->enum('batteryStatus', ["original", "replaced"])->nullable()->comment('حالة البطارية : أساسية و مستبدلة');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mob_tab_filters');
    }
};
