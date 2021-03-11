<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(7);
       
        return PostResource::collection($posts);
        
       
    }
    
    //Return all posts belonging to a specific category
    public function postsbycategory($id){
        
       $posts = Post::where('category_id',$id)->get();

       return PostResource::collection($posts);
       
      
    }

   
  
     
    //Return all breaking news
    public function getbreakingnews(){

        $posts = Post::where('breaking_news',true)->orderBy('created_at','desc')->get();

        return PostResource::collection($posts);

    }


    public function returnmonthpage($month){
        
        return view('frontend/month')->with('month',$month);
        
    }
    
    //Get post count by month
    public function getcountbymonth(){
        

        $posts = Post::selectRaw('month(created_at) month,count(*) count')
             ->groupBy('month')->get();
      
        return json_encode($posts);

    }

    //Get all posts belonging to a curtain month
    public function getbymonth($month){

        $posts = Post::whereMonth('created_at', '=', $month)->orderBy('created_at','desc')
              ->get();
        
        return PostResource::collection($posts);
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
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'breaking_news' => 'required',
            'tags' => 'required'

        ])->validate();


        $post = new Post();

        $post->title = strip_tags($request->get('title'));
        $post->description = $request->get('description');
        $post->category_id = $request->get('category_id');
        $post->admin_id = $request->get('admin_id');
      
        if(request()->file('image')) {
            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time() .'_'. $imageName; 
            $image->move(public_path('/images'),$imageName);

            $post->image = '/' . $imageName;
        }
        
        $post->breaking_news = $request->get('breaking_news');
        
        if($post->save()){
            
            $tags = json_decode($request->get('tags'));
         
            $post->tags()->attach($tags);

            return new PostResource($post);
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
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/edit-post')->with('post_id',$id);
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
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'breaking_news' => 'required',
            'tags' => 'required'

        ])->validate();


        $post = Post::findOrFail($id);

        $post->title = strip_tags($request->get('title'));
        $post->description = $request->get('description');
        $post->category_id = $request->get('category_id');
        $post->admin_id = $request->get('admin_id');
      
        if(request()->file('image')) {
            $image = request()->file('image');
            $imageName = $image->getClientOriginalName();
            $imageName = time() .'_'. $imageName; 
            $image->move(public_path('/images'),$imageName);

            $post->image = '/' . $imageName;
        }
            $post->breaking_news = $request->get('breaking_news');
        
        if($post->save()){
           
            $tags = json_decode($request->get('tags'));
            
            /*Add only the tags that are not already attached to this post 
            We dont want duplicated results */
            foreach($tags as $tag){
                $hasTag = $post->tags()->where('tag_id', $tag)->exists();
                if(!$hasTag){
                    $post->tags()->attach($tag);
                }
            }
      
            return new PostResource($post);
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::findOrFail($id);
        if($post) {
            $destroy = Post::destroy($id);
            if($destroy) {
                return json_encode('Post has been deleted');
            }
            else {
                return json_encode('Something went wrong');
            }
        }
    }

    
}
