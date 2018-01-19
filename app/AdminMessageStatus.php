<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessageStatus extends Model
{

    public $fillable = ['admin_message_id','user_id'];
}
