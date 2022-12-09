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
        Schema::create('hotel_appartments', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('floor_ar')->nullable();
            $table->string('floor_en')->nullable();
            // $table->double('lat')->nullable();
            // $table->double('lng')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->integer('night_price');
            $table->integer('discount')->nullable();
            $table->longText('features_ar')->nullable();
            $table->longText('features_en')->nullable();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_appartment_id')->constrained('type_appartments')->onDelete('cascade')->onUpdate('cascade');
            // $table->integer('likes')->default(0);
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
        Schema::dropIfExists('hotel_appartments');
    }
};