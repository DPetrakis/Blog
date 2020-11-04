<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

    

    
    //Get the category that this post belongs to 
    public function category() {
        return $this->belongsTo(Category::class);
    }

    //Get tags associated with this post 
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    //Return all comments of a post 
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    //Return the admin that created that post
    public function admin() {
        return $this->belongsTo(Admin::class);
    }

}
