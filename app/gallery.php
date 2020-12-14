<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $fillable = ['user_id', 'image_url' ];
    
     public function user () {
     	
    	return	$this->belongsToMany(User::class);
    	//many table gallery rows belongs to the table user rows
    }

}
