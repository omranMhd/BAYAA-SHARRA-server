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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('category_id')->comment('تمثل نوع الاعلان وهي واحدة من الصناف التي يدعمها الموقع');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->json('address')->comment('نضع مكان تواجد الاعلان ضمن اوبجكت جيسن (البلد-المدينة)');
            $table->json('location')->comment('نضع خط الطول والعرض في حال كان الاعلان عقار');
            $table->text('title', 50);
            $table->text('description');
            $table->integer('contactNumber');
            $table->integer('price');
            $table->integer('newPrice');
            $table->string('currency', 5);
            $table->enum('status', ["pending", "active", "rejected", "closed"])->comment('حالة');
            $table->boolean('paidFor')->comment('هل تم دفع الرسوم او لا');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
