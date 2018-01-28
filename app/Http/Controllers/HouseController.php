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


    // other column rules
    protected $otherRules =
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



    public function add()
    {

        if(! $data =$this->createValidator())
            return $this->getError();

        $r = $this->model->create($data);

        return $this->resultReturn($r->id);

    }


    /**
     * 创建一条数据时的验证器
     *
     * @Yuan1998
     * @DateTime 2018-01-26T14:04:30+0800
     * @return   Array|Boolean                   validate pass return data,unpass return false.
     */
    private function createValidator()
    {
        $cid = request()->commissioned_id;
        $uid = sessiony('user')->id;
        $r = $this->model->hasCommissioned()->where('id',$cid)->where('user_id',$uid)->exists();

        if(!$r)
            return false;

        return $this->validator($rule);

    }

    // return status list
    public function getStatusList()
    {
        // return all status
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
