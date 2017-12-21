<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $with = ['category','status','user','comments'];
    protected $fillable= ['subject','user_id','status_id','important','category_id','start','due'];
    public function  user(){
        return $this->belongsTo('App\User');
    }
    public function  category(){
        return $this->belongsTo('App\Category');
    }
    public function  status(){
        return $this->belongsTo('App\Status');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    protected $hidden = [
        'status_id', 'category_id','user_id'
    ];
}
