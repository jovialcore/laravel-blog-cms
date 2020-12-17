<?php

namespace App\Http\Controllers;

use App\gallery;
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
      $galleries = gallery::orderBy('id', 'DESC')->get();
      return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $this->validate($request, [
            'image_url' => 'required',
       ],

            [
                'image_url.required' => 'You must select and image'
            ]
   );
       //validateing image and saving the images . we will be looping because we will have multiple images
foreach ($request->image_url as $image_url) {
    //lets have fil extenesioin
    $imageNameWithExtension = $image_url->getClientOriginName();
//lets only the file name

    $imageName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // lest just get the image extension like .jpg or .img or so
    $imageExtension = $image_url -> getClientOriginExtension();
    // lets haev then image name and store in db

    $fileNameToSaveInDb = $imageName . '_'. time(). '.' .$imageExtension;
//lets save everything
    $gallery = new gallery();

    $gallery->user_id = Auth::id();
    $gallery->image_url = $fileNameToSaveInDb;
    $uploadedToDb = $gallery->save();
//check if the image name has been successfully saved in db
    if ($uploadedToDb) {
        $image_url->storeAs('public/galleries', $fileNameToSaveInDb);
    }

Session::flash('msg', 'images has been successfully uploaded.. thanks for banking with us');

return redirect()->route('galleries.index');

}

Session::flash('msg', 'page was successfuly created. Thamlk you..oshe');
    return redirect()->route('pages.index');
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
        $page  = post::findOrFail($id);

        return view('admin.pages.edit', compact('page'));
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
    
    $this->validate($request, [
            'thumbnail' => 'required',
            'title' => 'required|unique:posts,title,' .$id . ',id',
            //where titleis equal to what it is and $id is == id // i mean for the post above . Thats what it is meant for
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

        Session::flash('msg', 'page was successfuly created. Thamlk you..oshe');
            return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = post::findOrFail($id);
        $page->delete();

        Session::flash('del-msg', 'Page has been successfull
             deleted. Thanks for banking with us');
        return redirect()->route('pages.index');
    }
}
