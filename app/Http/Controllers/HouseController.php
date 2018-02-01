<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\House;

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
        'area'=>'required',
        'direction'=>'required',
        'floor'=>'required',
        'floors'=>'required',
        'house_img'=>'required',
        'Decoration'=>'required',
        'floor_age'=>'required',
        'supply_heating'=>'required',
        'elevator'=>'required',
        'surroundings'=>'required',
        'community_info'=>'required',
        'traffic'=>'required',
        'house_age_limit'=>'required',
        'huxing_map_info'=>'required',
        'room_count'=>'required',
        'deed_info'=>'required',
        'commissioned_id'=>'required|exists:commissioneds,id'
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

        if(! $data = $this->createValidator())
            return $this->getError();

        $this->saveImage($data);

        $r = $this->model->create($data);

        $cid = request()->commissioned_id;

        $r = DB::table('commissioneds')->where('id',$cid)->update(['status'=>'valuation']);

        return $this->resultReturn($r);

    }

    protected function saveImage(&$data)
    {


        $data['house_img'] = $this->parseArrBase64($data['house_img']);

        $data['deed_info'] = $this->parseBase64($data['deed_info'][0]);

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
        // $r = $this->model->hasCommissioned()->where('id',$cid)->exists();
        $r = DB::table('commissioneds')->where('id',$cid)->where('user_id',$uid)->first();
        if(!$r){
            $this->error = 'commissioned_id & user_id unfind';
            return false;
        }

        return $this->validator($this->otherRules);

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


    public function sendFile()
    {

        return $this->parseBase64(request('img'));

    }


}
