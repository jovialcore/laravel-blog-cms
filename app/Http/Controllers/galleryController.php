<?php

namespace App\Http\Controllers;

use App\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class galleryController extends Controller
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
    $imageNameWithExtension = $image_url->getClientOriginalName();
//lets only the file name

    $imageName = pathinfo($imageNameWithExtension, PATHINFO_FILENAME);
    // lest just get the image extension like .jpg or .img or so
    $imageExtension = $image_url -> getClientOriginalExtension();
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

Session::flash('msg', 'page was successfuly created. Thamlk you..oshe!!!');
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery)
    {
        //delete image from file
       
  Storage::delete('/public/galleries'. $gallery->image_url);

  //also delte imaga name from DB

  $gallery->delete();

  Session::flash('del-msg', 'image was deleted successfully from db');

  return redirect()->route('galleries.index');

    }
}
