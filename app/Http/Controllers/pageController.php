<?php

namespace App\Http\Controllers;

use App\category;
use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class pageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $pages = post::orderBy('id', 'DESC')->where('post_type', 'page')->get();
       return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

       $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required|unique:posts,title' .$id . ',id',
            'details' => 'required',

       ],

            [
                'thumbnail.required' => "Bia thubmnail is very importan o guy man",
                'title.required' => 'oga nah put title nah..kilode nah..oga simple title is that to hard to ask? nawah for you o',
                'title.unique' =>"you dy weak me self..don't you see that that title has been registered , daddy or mummy? ..i go change am for you o",

                'details.required' => 'Enter your details no vex',
            ]
   );

$page = post::findOrFail($id);
$page->user_id = Auth::id();
$page->thumbnail = $request->thumbnail;
$page->title = $request->title;
$page->slug = str_slug($request->title);
$page->sub_title = $request->sub_title;
$page->details = $request->details;
$page->is_published = $request->is_published;
$page->save();

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
        //
    }
}
