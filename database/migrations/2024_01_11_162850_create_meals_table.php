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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cook_id');
            $table->foreign('cook_id', 'foreign_meal_cooks')->references('id')->on('users');
            $table->string('name');
            $table->string('description');
            $table->string('meal_photo_path', 2048)->nullable();
            $table->float('price');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredients_id', 'foreign_meal_ingredient')->references('id')->on('ingredients');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
