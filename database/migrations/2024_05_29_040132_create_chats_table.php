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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_chat')->references('id')->on('users');
            $table->unsignedBigInteger('meal_schedule_id');
            $table->foreign('meal_schedule_id', 'schedule_chat')->references('id')->on('meal_schedules');
            $table->string('message');
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
