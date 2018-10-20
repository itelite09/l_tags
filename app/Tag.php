<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Image;

class Tag extends Model
{
    //
	public function images() {
		return $this->belongsToMany('App\Image');
	}
}
