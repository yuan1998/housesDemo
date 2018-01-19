<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageText extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public $table = 'messageText';

    public $fillable = ['content'];
}
