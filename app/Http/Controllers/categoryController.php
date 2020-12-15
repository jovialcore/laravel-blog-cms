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
        ]
    ,

        [  //here is a customized message for our errors..instead of the default error message provided porvided by laravel

            'thumbnail.required' => 'Enter thumbnail  url',
            'name.required' => 'Enter your name. Name field is empty',
            'name.unique' => 'Category already exist'
        ]);

        //lets work set session for this 

        $cat = new category;
        $cat->thumbnail = $request->thumbnail;
        $cat->user_id= Auth::id();
        $cat->name = $request->name;
        $cat->slug = str_slug($request->name);
        var_dump($cat->slug);

        $cat->is_published = $request->is_published;
        $cat->save();

        Session::flash('msg', 'Category has been created successfully');
        return redirect()->route('categories.index');

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
    public function edit(category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $this->validate($request, [

                'thumbnail' => 'required',
                'name' =>  'required|unique:categories,name,'.$category->id,
        ],
            [
                'thumbnail.required' => 'Enter thubnail please',
                'name.required' => 'Enter your name, G',
                'name.unique' => 'Category already exist',
            ]
    );

        $category->thumbnail =  $request->thumbnail;
        $category->user_id = Auth::id();
        $category->name=  $request->name;
        $category->slug = str_slug($request->name);
        $category->is_published = $request->is_published;
        $category->save();

        Session::flash('update-msg', 'Omo.. your stuff have been updated ...!');

        return redirect()->route('categories.index');
        //omo so you must refer back to your the route in web.php that must hit the index method above..omo

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //refer to laravel doc to understand whats going on here:  Route Binding(Implicit Binding)
        
        $category->delete();
        Session::flash('del-msg', 'Omo category has been removed o..omo!');
        return redirect()->route('categories.index');
    }
}
