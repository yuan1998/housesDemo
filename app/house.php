<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //
	protected $guarded = ['id'];

	public $table = 'houses';

   protected $casts=
   [
      'tags'=>'json',
      'huxing_map_info'=>'json',
      'house_img'=>'json',
      'room_count'=>'json',
      'deed_info'=>'json',
      'location_info'=>'json'
   ];

   public function hasCommissioned()
   {
      return $this->hasOne('\App\Commissioned','id','commissioned_id');
   }

   public function user(){
      return $this->belongsTo('\App\User');
   }

   public function hasReservation(){
      return $this->hasMany('\App\Reservation','reservation_house_id','id');
   }

}
