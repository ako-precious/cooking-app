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
            $table->string('name', 50)->nullable();
            $table->string('region', 30)->nullable();
            $table->string('description',600)->nullable();
            // $table->unsignedBigInteger('photo_id')->nullable();
            // $table->foreign('photo_id', 'foreign_meal_photo')->references('id')->on('meal_photos')->nullOnDelete();
            $table->float('price', 8, 2)->default(10.00);
            $table->json('ingredients')->nullable();
            $table->integer('cooking_limit')->default(10);
            $table->enum('status', ['pending', 'available'])->default('pending');
            
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
