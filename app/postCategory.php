<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postCategory extends Model
{
    protected $fillable = ['category_id', 'post_id'];
}
