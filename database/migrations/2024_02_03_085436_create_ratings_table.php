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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('meal_id')->nullable();
            $table->foreign('meal_id', 'foreign_meal_rating')->references('id')->on('meals');            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'foreign_user_rating')->references('id')->on('users');
            $table->tinyInteger('presentation');
            $table->tinyInteger('taste');
            $table->tinyInteger('value');
            $table->tinyInteger('nutrition');
            $table->tinyInteger('variety'); 
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
