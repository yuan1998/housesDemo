<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commissioned extends Model
{
    public $fillable = [
      'community',
      'unit_number',
      'building_number',
      'house_number',
      'contact',
      'tel',
      'user_id',
      'expect_price',
      'city',
   ];

   public $guarded = ['id'];
}
