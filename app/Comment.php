<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Return the post associated with this comment
    public function post() {
 
        return $this->belongsTo(Post::class);
    }

    //Return the user associated with this comment
    public function user(){

        return $this->belongsTo(User::class);
    }
}
