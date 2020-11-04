<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    //Get all posts associated with this tag
    public function posts() {

        return $this->belongsToMany(Post::class);

    }
}
