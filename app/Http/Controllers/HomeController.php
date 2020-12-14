<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\category;
use App\post;
use App\page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = category::orderBy('id', 'DESC')->limit('3')->get();
        $posts = post::orderBy('id', 'DESC')->where('post_type', 'post')->limit('3')->get();
        $pages = post::orderBy('id', 'DESC')->where('post_type', 'page')->limit('3')->get();

        return view('admin.index', compact('categories', 'posts', 'pages'));
    }
}
