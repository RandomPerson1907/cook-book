<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationToIngredientRecipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("recipe_id")->unsigned();
            $table->bigInteger("ingredient_id")->unsigned();
            $table->string("ingredient_count");

            $table->foreign("recipe_id")->references("id")->on("recipes")->onDelete("cascade");
            $table->foreign("ingredient_id")->references("id")->on("ingredients")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("ingredient_recipe");
    }
}
