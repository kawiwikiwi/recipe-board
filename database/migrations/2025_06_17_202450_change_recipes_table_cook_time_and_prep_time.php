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
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('cook_time');
            $table->dropColumn('prep_time');

            $table->time('cook_time')->nullable();
            $table->time('prep_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('cook_time');
            $table->dropColumn('prep_time');

            $table->integer('cook_time')->nullable();
            $table->integer('prep_time')->nullable();
        });
    }
};
