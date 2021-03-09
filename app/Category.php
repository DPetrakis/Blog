<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];
    
    //Return all posts associated with a curtain category
    public function posts(){

        return $this->hasMany(Post::class);
    }
}
