<?php

namespace App\Http\Controllers;


use App\post;
use App\category;
use Illuminate\Http\Request;


class blogController extends Controller
{
    public function index() 
    {
        $cat = category::orderBy('name', 'ASC')->where('is_published', '1')->get();

        $thePosts = post::orderBy('id', 'DESC')->where('post_type', 'post')->where('is_published', '1')->paginate(5);

        return view('webapp.index', compact('thePosts' ,'cat'));
    }


    public function post($slug) 
    {
    	$post = post::where('slug', $slug)->where('post_type', 'post')->where('is_published', '1')->first();
    	//note that because of ->first() --we don't need to loop in our post page template(htnl)

    	if ($post) {
    		return view('webapp.post', compact('post'));
    	} else {
    		return \Response::view('webapp.errors.404', array(), 404);
    	}
    }

    public function category($slug) 
    {
    	$category = category::where('slug', $slug)->where('is_published', '1')->first();
    	//here it will hit the slug i.e links first before fetching the post related to the pots after the if statement

    	if($category) {
    		$postsRelatedToCatgories = $category->post()->orderBy('post_id', 'DESC')->where('is_published', '1')->paginate(5);
    		return view('webapp.categories', compact('category', 'postsRelatedToCatgories'));
    	} else {
    		return \Response::view('webapp.errors.404', array(), 404);
    	}

    }

    public function page($slug) {
        $page = post::where('slug', $slug)->where('post_type', 'page')->where('is_published', '1')->first();
        if ($page) {
            return view('webapp.page', compact('page'));
        } else {
            return \Response::view('webapp.errors.404', array(), 404);
        }
    }
}


