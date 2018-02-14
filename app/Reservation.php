<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "houses_reservations";

    protected $guarded = ['id'];

    protected $fillable = ['reservation_id','reservation_house_id','date','status'];
}
