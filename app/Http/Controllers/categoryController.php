<?php

namespace App\Http\Controllers;



use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [

                'thumbnail' => 'required',
                'name' => 'required|unique:categories'
        ], 

        [
            'thumbnail.required' => 'Enter thumbnail url',
            'name.required' => 'Enter your name. Name field is empty',
            'name.unique' => 'Category already exist'
        ]);

        //lets work set session for this 

        $cat = new category;
        $cat->thumbnail = $request->thumbnail;
        $cat->user_id= Auth::id();
        $cat->name = $request->name;
        $cat->slug = str_slug($request->slug);
        $cat->is_published = $request->is_published;
        $cat->save();

        Session::flash('msg', 'Category has been created successfully');
        return redirect()->route('categoriess.index');

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
