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
        Schema::create('cooks', function (Blueprint $table) {  
            $table->id();        
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'foreign_key_name')->references('id')->on('users');
            $table->string('certificate')->nullable();
            $table->string('means_of_id')->nullable();
            $table->longText('other_info')->nullable();
            $table->enum('status', ['pending','unavailable', 'available'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooks');
    }
};
