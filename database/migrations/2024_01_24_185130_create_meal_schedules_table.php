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
        Schema::create('meal_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id', 'meal_schedule')->references('id')->on('meals');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_meal_schedule')->references('id')->on('users');
            $table->string('meal_time');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'rejected', 'accepted', 'processed', 'ready', 'in transit', 'delivered', 'confirmed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_schedules');
    }
};
