<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \app\house;

class HouseController extends ApiController
{

    // status list
    private $statusList =
    [
        'audit'=>'审核中',
        'sell'=>'在售',
        'paying'=>'交易中',
        'complete'=>'完成',
        'close'=>'关闭'
    ];


    // create rules
    private $createRules =
    [
        'community'=>'required',
        'expect_price'=>'required',
        'contact'=>'required',
        'tel'=>'required',
        'building'=>'required',
        'unit'=>'required',
        'house_number'=>'required',
        // 'user_id'=>'e'
    ];


    // other column rules
    private $otherRules =
    [
        'title'=>array('required','filled','max:50'),
        'sub_title'=>array('required','filled','max:50'),
        'area'=>'required',
    ];

    public function __construct(){
      $this->model = new House;
   }


    // create table
    public function createTable()
    {
        //  validate result
        if(!$data = self::validator($this->createRules))
            return $this->getError();

        if( !($data['user_id'] = session('user')->id))
            return err('request user error');

        // remove error data
        if(!$data = $this->filterData($data))
            return err('empty params');

        // validate pass save data;
    	$r = $this->model->create($data);
    	return $r ? suc($r->id) : err('error');
    }

    // return status list
    public function getStatusList()
    {
        // get all status
    	return suc($this->statusList);
    }


    // change status
    public function statusChange()
    {
        // get change condition and data
        // validate id exists
        if(!$id = request('id') || !$this->model->where('id',$id)->first())
            return err('id exists.');
        // validate status exists
        if(!$status = request('status'))
            return err('params error');

        // validate pass change data;
        $this->model->where('id',$id)->update(['status'=>$status]);
    }

    /**
     * search api
     */
    protected function mainSearch()
    {

        return $this->model->where('status','sell')->get();
    }

    /**
     *  where keyword;
     */
    protected function whereKeyword($on = null,$keyword = null)
    {
        $this->model->where($on,$keyword);
        return $this->mainSearch();
    }

    /**
     *  on title search
     */
    public function titleSearch()
    {
        if(!($keyword = $this->keywordValidator()))
            return err('params error');
        $result = $this->mainSearch('title',$keyword);
        return $result !== false ? suc($result) : err('error');
    }

    /**
     *  get selling houses
     */
    public function getSellingHouses()
    {
        $r = $this->mainSearch();
        return $r !== false ? suc($r) : err('error');
    }

    /**
     *  search keyword validator
     */
    protected function keywordValidator()
    {
        $keyword = request('keyword');
        return $keyword ?: false;
    }
}
