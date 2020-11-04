<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);
        
        return CommentResource::collection($comments);
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
        $comment = new Comment();

        $comment->description = strip_tags($request->description);
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;

        //Check to see if the user sumbitting the comment is the current loged in user
        if($comment->user_id == Auth::user()->id){
            
            if($comment->save()) {
            
                return new CommentResource($comment);
         
            }
      
        }
        else {
          return   json_encode("You dont have permission to sumbit comments with somebody's else account");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment =  Comment::findOrFail($id);
        if($comment) {
            $destroy = Comment::destroy($id);
            if($destroy) {
                return json_encode('Comment has been deleted');
            }
            else {
                return json_encode('Something went wrong');
            }
        }
    }
}
