<?php

namespace App\Http\Controllers;

use App\category;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPost = post::orderBy('id', 'DESC')->where('post_type', 'post')->get();
        return view('admin.post.index', compact('allPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $categories = category::orderBy('name', 'ASC')->pluck('name', 'id');
         return view('admin.post.create', compact('categories'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate( $request, [
            "thumbnail"=> 'required',
            "title" => 'required|unique:posts',//checks if post has already been stored in the database
            "details" => 'required',
            "category_id" => "required"
        ],
    [
            'thumbnail' => 'Enter thumbnail url',
            'title.required' => 'enter title my friend',
            'title.unique' => 'title alreay exist, baba',
            'details.required' => 'Man..enter details ain you getting the point??',
            'category_id.required' => 'You must select a category o..na must G'
            ]
);

$post = new post();

$post->user_id = Auth::id();
$post->thumbnail = $request->thumbnail;
$post->title = $request->title;
$post->slug = str_slug($request->title);
$post->sub_title = $request->sub_title;
$post->details = $request->details;
$post->is_published = $request->is_published;
$post->post_type = 'post';
$post->save();

$post->categories()->sync($request->category_id, false);
//refer to lavalite for proper understanding
//for laravel 5.4 this prevents the removal of old (old entries) category_ids from our intermediate table: post_categoories 
        // for laravel 7,8: optional method is  $post->catgories->syncWithoutDetaching($request->category_id)
//so here we want to attach one category_id to this post without removing other related category_ids of post in our intermediate table post_categories  table

Session::flash('msg', 'Post has been created wonderfully and successfully..what do you all think about it');
return redirect()->route('posts.index');//remember that this is the route uri and not th file path!!! 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
  
    }
}
