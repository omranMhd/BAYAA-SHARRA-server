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
        Schema::create('real_estate_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertisement_id');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->integer('area');
            $table->enum('areaUnit', ["meter","kilo","donom","kasaba","theraa","fadan"]);
            $table->integer('floor');
            $table->enum('cladding', ["haikal","maksy","mafrosh"])->comment('الاكساء (عظم او مكسي)');
            $table->enum('sellOrRent', ["sell","rent"])->comment('بيع او أجار');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_filters');
    }
};
