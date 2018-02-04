<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    public $fillable = ['message_id','rec','title'];

    public function message()
    {
       // return $this->belongsToMany('App\MessageText','envelopes','message_id','id');
       // return $this->hasMany('App\MessageText','id','message_id');
      return $this->belongsTo('\App\MessageText','message_id');
    }

    public function status()
    {
      return $this->hasOne('\App\AdminMessageStatus','admin_message_id')->where('user_id',sessiony('user')->id);
    }

    public function unread()
    {

    }
}
