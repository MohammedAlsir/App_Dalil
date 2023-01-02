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
        Schema::create('car_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('car_id')->nullable()->constrained('cars')->onDelete('cascade')->onUpdate('cascade');
            $table->date('from');
            $table->date('to');
            $table->integer('days');
            $table->integer('day_price'); // سعر اليوم
            $table->integer('driver_price')->nullable(); // سعر السائق
            $table->integer('discount')->nullable();
            $table->integer('total');
            $table->string('notes')->nullable();
            $table->string('notice_photo')->nullable();
            // 0 => new
            // 1 => initial_acceptance
            // 2 => accepted
            $table->enum('status', [0, 1, 2])->default(0);
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
        Schema::dropIfExists('car_requests');
    }
};
