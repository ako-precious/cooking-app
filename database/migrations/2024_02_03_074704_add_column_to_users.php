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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('means_of_id')->nullable();
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->foreign('badge_id', 'user_badge')->references('id')->on('badges');
            $table->unsignedBigInteger('DRA_id')->nullable();
            $table->foreign('DRA_id', 'user_Dietary_restrictions_allergies')->references('id')->on('dietary_restrictions_allergies');
            $table->longText('other_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
