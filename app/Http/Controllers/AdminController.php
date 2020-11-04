<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/index');
    }

    public function postspage()
    {
        return view('admin/posts');
    }

    public function categoriespage()
    {
        return view('admin/categories');
    }

    public function commentspage()
    {
        return view('admin/comments');
    }

    public function tagspage()
    {
        return view('admin/tags');
    }

    public function blockspage()
    {
        return view('admin/blocks');
    }

    public function rolespage()
    {
        return view('admin/roles');
    }


  
    
}
