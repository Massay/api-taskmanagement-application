<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $with = ['user'];
    protected $fillable = ['body','task_id','user_id'];
    
    public function task(){
        return $this->belongsTo('App\Task');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
