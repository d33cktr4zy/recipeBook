<?php

namespace recipeBook;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = ['name','image','user_id','recipeCategory_id','step', 'pax'];

    public function details(){
        return $this->hasMany('recipeBook\RecipeDetail');
    }

    public function category(){
        return $this->belongsTo('recipeBook\RecipeCategory');
    }
}
