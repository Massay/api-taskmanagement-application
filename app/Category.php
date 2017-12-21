<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//protected $with = ['tasks'];
	
   public function tasks(){
	return $this->hasMany('App\Task');
	}
}
