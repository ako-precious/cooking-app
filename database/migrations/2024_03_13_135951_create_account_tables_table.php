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
        Schema::create('account_tables', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_notification')->references('id')->on('users');
            $table->string('stripe_account_id')->default('false');
            $table->boolean('charges_enabled')->default('false');
            $table->boolean('transfer_enabled')->default('false');
            $table->boolean('detailed_submitted')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_tables');
    }
};
