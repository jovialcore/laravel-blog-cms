<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable = ['user_id', 'thumbnail', 'title', 'slug', 'sub_title', 'details', 'post_type', 'is_published'];


    public function user() {
    	//oneTomany relationship..inverse 
    	return $this->belongsTo(User::class);

    	//table post rows belongs to One user 
    	 }

    	  public function categories() {
    	 	return $this->belongsToMany(category::class, 'post_categories'); 
    	 	//posts is related to many categories and many categories are related to many posts 
    	 	//the table through which they are related is 'post_category' table

            //manyTomany relationship is just One to One relationship one left and oneToOne relationship of another table from the right 
    	 }
}

