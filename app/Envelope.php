<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envelope extends Model
{
    protected $guarded = ['id'];


    public function message()
    {
       // return $this->belongsToMany('App\MessageText','envelopes','message_id','id');
       return $this->hasMany('App\MessageText','id','message_id');
    }
}
