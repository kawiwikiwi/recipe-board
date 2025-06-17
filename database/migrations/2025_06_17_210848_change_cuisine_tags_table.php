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
        Schema::dropIfExists('cuisine_tags');

        Schema::create('cuisine_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->string('cuisine_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuisine_tags');
        
        Schema::create('cuisine_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->enum('cuisine_type', [
                'african',
                'american',
                'brazilian',
                'british',
                'caribbean',
                'chinese',
                'french',
                'greek',
                'indian',
                'japanese',
                'korean',
                'mediterranean',
                'mexican',
                'middle_eastern',
                'spanish',
                'thai',
                'turkish',
                'other'
            ]);
            $table->string('other')->nullable();
            $table->timestamps();
        });
    }
};
