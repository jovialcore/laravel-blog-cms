<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['user_id', 'thumbnail', 'name', 'slug', 'is_published'];

    public function user () {
    	return $this->belongsTo(User::class);
    	// table category rows belongs to one user row
    }

        public function post () {
            
    	return $this->belongsToMany(Post::class, 'post_categories');
    	//many table category rows is related to the table post rows
    	//the second argument is
    }



}
