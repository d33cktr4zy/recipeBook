<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->unique();
            $table->string('image')->nullable()->default(null);
            $table->unsignedBigInteger('recipeCategory_id');
            $table->longText('step')->nullable();
            $table->string('pax')->nullable();
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
//            $table->foreign('recipeCategory_id')->references('id')->on('recipe_categories')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
