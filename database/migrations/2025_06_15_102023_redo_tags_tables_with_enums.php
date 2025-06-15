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
        Schema::dropIfExists('dietary_tags');
        Schema::dropIfExists('allergy_tags');
        Schema::dropIfExists('cuisine_tags');
        
        Schema::create('dietary_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->enum('dietary_requirement', [
                'vegetarian',
                'vegan',
                'pescatarian',
                'halal',
                'kosher',
                'gluten_free',
                'dairy_free',
                'low_calorie',
                'low_carb',
                'low_fat',
                'low_sugar',
                'low_sodium',
                'high_protein',
                'keto'
            ]);
            $table->timestamps();
        });

        Schema::create('allergy_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->enum('allergy_requirement', [
                'celery',
                'crustaceans',
                'eggs',
                'fish',
                'gluten',
                'lupin',
                'milk',
                'molluscs',
                'mustard',
                'nuts',
                'peanuts',
                'sesame',
                'soybeans',
                'sulphites'
            ]);
            $table->timestamps();
        });

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dietary_tags');
        Schema::dropIfExists('allergy_tags');
        Schema::dropIfExists('cuisine_tags');

        Schema::create('dietary_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->boolean('vegetarian')->default(false);
            $table->boolean('vegan')->default(false);
            $table->boolean('pescatarian')->default(false);
            $table->boolean('halal')->default(false);
            $table->boolean('kosher')->default(false);
            $table->boolean('gluten_free')->default(false);
            $table->boolean('dairy_free')->default(false);
            $table->boolean('low_calorie')->default(false);
            $table->boolean('low_carb')->default(false);
            $table->boolean('low_fat')->default(false);
            $table->boolean('low_sugar')->default(false);
            $table->boolean('low_sodium')->default(false);
            $table->boolean('high_protein')->default(false);
            $table->boolean('keto')->default(false);
            $table->timestamps();
        });

        Schema::create('allergy_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->boolean('celery')->default(false);
            $table->boolean('crustaceans')->default(false);
            $table->boolean('eggs')->default(false);
            $table->boolean('fish')->default(false);
            $table->boolean('gluten')->default(false);
            $table->boolean('lupin')->default(false);
            $table->boolean('milk')->default(false);
            $table->boolean('molluscs')->default(false);
            $table->boolean('mustard')->default(false);
            $table->boolean('nuts')->default(false);
            $table->boolean('peanuts')->default(false);
            $table->boolean('sesame')->default(false);
            $table->boolean('soybeans')->default(false);
            $table->boolean('sulphites')->default(false);
            $table->timestamps();
        });

        Schema::create('cuisine_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->boolean('african')->default(false);
            $table->boolean('american')->default(false);
            $table->boolean('brazilian')->default(false);
            $table->boolean('british')->default(false);
            $table->boolean('caribbean')->default(false);
            $table->boolean('chinese')->default(false);
            $table->boolean('french')->default(false);
            $table->boolean('greek')->default(false);
            $table->boolean('indian')->default(false);
            $table->boolean('japanese')->default(false);
            $table->boolean('korean')->default(false);
            $table->boolean('mediterranean')->default(false);
            $table->boolean('mexican')->default(false);
            $table->boolean('middle_eastern')->default(false);
            $table->boolean('spanish')->default(false);
            $table->boolean('thai')->default(false);
            $table->boolean('turkish')->default(false);
            $table->string('other')->nullable();
            $table->timestamps();
        });
    }
};
