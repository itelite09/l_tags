<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = ['url', 'tags'];
    //
	public function tags() {
		return $this->belongsToMany('App\Tag');
	}
}
