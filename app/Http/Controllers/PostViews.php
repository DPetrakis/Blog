<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostViews extends Controller
{
    public function showpost($id){
     
       return view('frontend/post')->with('post_id',$id);
    }
}
