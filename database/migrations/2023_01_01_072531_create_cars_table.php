<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar'); // الاسم
            $table->string('name_en'); // الاسم
            // $table->string('company')->nullable(); // اسم الشركة
            // $table->string('model')->nullable(); // الموديل
            // 1 = صغيرة - small
            // 2 = متوسطة - Medium
            // 3 = كبيرة - Big
            // 4 = فاخرة - Deluxe
            // 5 = عائلية - Familial
            // 6 = مراسم - Ceremony
            $table->enum('type', [1, 2, 3, 4, 5, 6]); // نوع السيارة
            $table->integer('number_of_passengers'); // عدد الركاب
            $table->integer('number_of_doors'); // عدد الابواب
            $table->integer('day_price'); // سعر اليوم
            $table->integer('driver_price')->nullable(); // سعر السائق
            $table->longText('features_ar'); //  المميزات
            $table->longText('features_en'); //  المميزات
            // 1 = اوتوماتيك - Automatic
            // 2 = عادي - Normal
            $table->enum('motion_vector', [1, 2]); // ناقل الحركة
            // $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
