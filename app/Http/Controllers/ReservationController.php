<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Reservation;


class ReservationController extends ApiController
{

    /**
     * The Construct is New Reservation model .
     * @Yuan1998
     * @DateTime 2018-02-14T12:54:30+0800
     */
    public function __construct()
    {
        $this->model = new Reservation;
    }

    /**
     * The Method is create new reservation .
     * @Yuan1998
     * @DateTime 2018-02-14T12:54:53+0800
     * @return   [type]                   [description]
     */
    public function newReservation()
    {
        $id = sessiony('user')->id;
        $hid = request('hid');
        $date = request('date');
        $status = 'unStart';

        $r = $this->model->create(['date'=>$date,'reservation_id'=>$id,'reservation_house_id'=>$hid,'status'=>$status]);


        return $this->resultReturn($r->id);
    }


    /**
     * The Method is check user is reservation the house(resquest->house_id)
     * @Yuan1998
     * @DateTime 2018-02-14T12:55:34+0800
     * @return   [type]                   [description]
     */
    public function checkIsReservation()
    {
        $id = sessiony('user')->id;
        $hid = request('hid');

        $r = $this->model->where('reservation_id',$id)->where('reservation_house_id',$hid)->where('status','unStart')->first();

        return $this->resultReturn($r);
    }
}
