<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\Post as PostResource;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
    
        $tags = Tag::orderBy('created_at', 'desc')->paginate(5);

        return TagResource::collection($tags);
    }

    public function getpostsbytag($id){

        $tag = Tag::find($id);
        
        $posts = $tag->posts;

        return PostResource::collection($posts);
     
    }

    public function returntagpage($tag){
        
        return view('frontend/tag')->with('tag',$tag);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag;
        
        $tag->name = $request->tag_name;

        if($tag->save()){
          return   json_encode('Tag has been created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Tag::findOrFail($id);

        return new TagResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->name = $request->tag_name;
        
        $tag->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag =  Tag::findOrFail($id);
        if($tag) {
            $destroy = Tag::destroy($id);
            if($destroy) {
                return json_encode('Tag has been deleted');
            }
            else {
                return json_encode('Something went wrong');
            }
        }
    }
}
