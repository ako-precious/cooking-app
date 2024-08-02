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
        Schema::table('cooks', function (Blueprint $table) {
            $table->string('question1',600)->nullable();
            $table->string('question2',600)->nullable();
            $table->string('question3',600)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cooks', function (Blueprint $table) {
            //
        });
    }
};
