<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('meals', function (Blueprint $table) {
            // Drop the existing column
           
        // Drop the check constraint
        DB::statement('ALTER TABLE meals DROP CONSTRAINT CK__meals__status__662B2B3B');

        // Drop the column
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Recreate the column with the desired type and constraint
        Schema::table('meals', function (Blueprint $table) {
            $table->enum('status', ['pending','unavailable', 'available'])->default('pending');
        });
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            // Drop the column again if you need to rollback
            $table->dropColumn('status');

            // Recreate the column with the previous type if needed
            $table->string('status')->nullable();
        });
    }
};
