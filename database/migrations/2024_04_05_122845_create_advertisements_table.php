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
            $table->string('address')->comment('نضع مكان تواجد الاعلان ضمن اوبجكت جيسن (البلد-المدينة)');
            $table->string('location')->nullable()->comment('نضع خط الطول والعرض في حال كان الاعلان عقار');
            $table->text('title', 50);
            $table->text('description');
            $table->string('contactNumber')->comment('عبارة عن اوبجكت جيسون فيه مثلا رقمين للتواصل مع اسم لكل رقم');
            $table->enum('status', ["pending", "active", "rejected", "closed"])->default("pending")->comment('حالة');
            $table->boolean('paidFor')->default(0)->comment('هل تم دفع الرسوم او لا');
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
