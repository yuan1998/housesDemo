<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envelope extends Model
{
    protected $guarded = ['id'];


    public function message()
    {
       // return $this->belongsToMany('App\MessageText','envelopes','message_id','id');
       // return $this->hasMany('App\MessageText','id','message_id');
      return $this->belongsTo('\App\MessageText','message_id');
    }

    public function receiver() {
      return $this->belongsTo('\App\User', 'user_id')->select('id', 'username', 'avatar_url');
   }

   public function sendUser()
   {
      return $this->belongsTo('\App\User','send_id')->select('id', 'username', 'avatar_url');
   }
}
