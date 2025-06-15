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
        Schema::dropIfExists('ingredients');

        Schema::dropIfExists('recipes_ingredients');

        Schema::dropIfExists('recipes');

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->unique();
            $table->integer('makes')->nullable();
            $table->integer('serves')->nullable();
            $table->integer('cook_time')->nullable();
            $table->integer('prep_time')->nullable(); 
            $table->enum('difficulty', ['easy', 'medium', 'hard', 'expert', 'master'])->default('easy');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->string('name')->unique();
            $table->double('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
        });

        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->integer('step_number');
            $table->string('title')->nullable();
            $table->text('instruction')->nullable();
            $table->timestamps();
        });

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('recipes');
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('steps');
        Schema::dropIfExists('dietary_tags');
        Schema::dropIfExists('allergy_tags');
        Schema::dropIfExists('cuisine_tags');


        Schema::create('recipes_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->foreignId('ingredient_id')->constrained('ingredients');
            $table->double('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->timestamps();
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('prep_time')->nullable();
            $table->string('cook_time')->nullable();
            $table->string('additional_time')->nullable();
            $table->string('total_time')->nullable();
            $table->integer('serves')->nullable();
            $table->integer('makes')->nullable();
            $table->text('instructions');
            $table->timestamps();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }
};
