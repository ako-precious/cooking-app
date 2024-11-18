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
        Schema::create('resource', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_post')->references('id')->on('users');
            $table->longText('content');
            $table->string('category');
            $table->string("post_photo_path", 2048)->nullable();
            $table->string('read_time');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource');
    }
};
