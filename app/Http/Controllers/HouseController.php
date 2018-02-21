<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\AdminMessageController as admin;
use \App\House;

class HouseController extends ApiController
{

    /**
     * The Arrtribute is All Status;
     * @var Array
     */
    private $statusList =
    [
        'audit'=>'审核中',
        'pass'=>'审核通过',
        'sell'=>'在售',
        'paying'=>'交易中',
        'complete'=>'完成',
        'close'=>'关闭'
    ];

    /**
     * The Arrtribute Is Audit Pass Send Message content;
     * @var string
     */


    public $Pi = 3.14159265359;


    public $oPi = (3.14159265359/180);

    /**
     * The Arrtribute Is Creating Validate Rule
     * @var [type]
     */
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
        'community'=>'required',
        'unit_number'=>'required',
        'building_number'=>'required',
        'house_number'=>'required',
        'contact'=>'required',
        'tel'=>'required',
        'expect_price'=>'required',
        'city'=>'required',
        'location'=>'required',
        'location_info'=>'required'
    ];

    /**
     * The Methis Is Construct , new House Model
     * @Yuan1998
     * @DateTime 2018-02-02T22:53:28+0800
     */
    public function __construct(){
      $this->model = new House;
   }


   /**
    * The Method Is Create House Api
    *
    * @Yuan1998
    * @DateTime 2018-02-02T22:51:53+0800
    */
    public function add()
    {

        if(! $id = userIsLogin())
         return err('not user log');

        if(! $data = $this->createValidator())
            return $this->getError();

        $data['user_id'] = $id;

        $r = $this->model->create($data);

        if($r)
            $this->houseAuditPass($r->id);

        return $this->resultReturn($r->id);

    }


    /**
     * The Method is Creating Save Img.
     *
     * @Yuan1998
     * @DateTime 2018-02-02T22:44:06+0800
     * @param    Array                   &$data [description]
     * @return   [type]                          [description]
     */
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

        $uid = sessiony('user')->id;

        return $this->validator($this->otherRules);

    }

    /**
     * The Method is Return This Attribute Status List ;
     * @Yuan1998
     * @DateTime 2018-02-02T22:45:09+0800
     * @return   Array                   [description]
     */
    public function getStatusList()
    {
        // return all status
    	return suc($this->statusList);
    }


    /**
     * The Method Is Change House Status;
     * @Yuan1998
     * @DateTime 2018-02-02T22:46:41+0800
     * @return   [type]                   [description]
     */
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
     * The Method is All Search Method core;
     * @Yuan1998
     * @DateTime 2018-02-02T22:47:08+0800
     * @return   [type]                   [description]
     */
    protected function mainSearch()
    {

        return $this->model->where('status','sell')->get();
    }

    /**
     * The Method is Where Model;
     * @Yuan1998
     * @DateTime 2018-02-02T22:47:39+0800
     * @param    [type]                   $on      [description]
     * @param    [type]                   $keyword [description]
     * @return   [type]                            [description]
     */
    protected function whereKeyword($on = null,$keyword = null)
    {
        $this->model->where($on,$keyword);
        return $this->mainSearch();
    }

    /**
     * The Method is on Title Search
     * @Yuan1998
     * @DateTime 2018-02-02T22:48:04+0800
     * @return   [type]                   [description]
     */
    public function titleSearch()
    {
        if(!($keyword = $this->keywordValidator()))
            return err('params error');
        $result = $this->mainSearch('title',$keyword);
        return $result !== false ? suc($result) : err('error');
    }



    /**
     * The Method is Validate Keyword
     *
     * @Yuan1998
     * @DateTime 2018-02-02T22:50:21+0800
     * @return   [type]                   [description]
     */
    protected function keywordValidator()
    {
        $keyword = request('keyword');
        return $keyword ?: false;
    }


    /**
     * The Method Is ...
     *
     * @Yuan1998
     * @DateTime 2018-02-02T22:50:46+0800
     * @return   [type]                   [description]
     */
    public function sendFile()
    {

        return $this->parseBase64(request('img'));

    }


    /**
     * The Method is Get paginate Houses, One Page 5 items;
     * @Yuan1998
     * @DateTime 2018-02-02T22:59:16+0800
     * @return   [type]                   [description]
     */
    public function getUserHouse()
    {
        if(!$id = userIsLogin())
            return err('user is not Login');

        $r = $this->model->where('user_id',$id)->orderBy('id','desc')->paginate(6);

        return $this->resultReturn($r);
    }


    /**
     * The Method is House Audit Pass change Status Api
     * @Yuan1998
     * @DateTime 2018-02-03T14:36:01+0800
     * @return   [type]                   [description]
     */
    public function houseAuditPass($hid = null)
    {
        if(! $hId = $hid ?: request('hid') )
            return err('house_id error');

        $hD = $this->model->find($hId);

        if(!$hD)
            return err('id error');

        $hD->status = 'pass';

        $r = $hD->save();

        if(!$r)
            return err('error');


        $title ="您在{$hD->city}{$hD->community}的房子已经通过审核，请尽快补充资料";

        $passMessage= "您的房子已经通过审核，请尽快补充资料和价格，我们将会为你上架。<br><a class='am-link' href='#/yezhu/addData/{$hId}'>去补充资料！</a>";

        $r = admin::sendMessage($passMessage,$title,$hD->user_id);


        return $r? suc() :err('send Message Error');

    }

    /**
     * The Method is Validate The Commissioned is now User Commissioned
     * @Yuan1998
     * @DateTime 2018-02-03T14:37:20+0800
     */
    public function isUserHouse()
    {
        if(! $r = $this->userHouse())
            return err();

        if($r->status != 'pass')
            return err();

        return $this->resultReturn($r);
    }


    /**
     * The Method is Find User_id And House_id House exists;
     * @Yuan1998
     * @DateTime 2018-02-03T16:09:28+0800
     * @return   [type]                   [description]
     */
    public function userHouse()
    {
        if(!$id = userIsLogin())
            return false;

        $hid = request('id');

        $r = $this->model->where('id',$hid)->where('user_id',$id)->first();

        return $r;
    }


    /**
     * The is Public Api, All people can use, get Selling House Info
     *
     * @Yuan1998
     * @DateTime 2018-02-04T12:11:26+0800
     */
    public function sellingHouseInfo(){

        $hid = request('id');

        $r = $this->model
                ->with('user')
                ->with(['hasReservation'=>function($q){
                    $q->where('date','>',(time() - day())*1000);
                }])
                ->where('id',$hid)
                ->where('status','sell')
                ->first();

        return $this->resultReturn($r);

    }

    /**
     * The Method is addHouse last Data Api;
     *
     * @Yuan1998
     * @DateTime 2018-02-03T16:09:57+0800
     */
    public function addData()
    {

        if(!$r = $this->userHouse())
            return err();

        if(!$data = $this->addDataValidator())
            return $this->getError();
        $data['status'] = 'sell';
        $result = $r->fill($data)->save();

        return $this->resultReturn($result);
    }

    /**
     * The Method is Add Data validator
     * @Yuan1998
     * @DateTime 2018-02-03T16:10:28+0800
     */
    public function addDataValidator()
    {

        $rule = [
            'title'=>'required',
            'sub_title'=>'required',
            'product_info'=>'required',
            'price'=>'required'
        ];

        $data =[
            'title'=>request('title'),
            'sub_title'=>request('sub_title'),
            'product_info'=>request('product_info'),
            'price'=>request('price'),
            'tags'=>request('tags')
        ];


        return $this->validator($rule,$data);

    }

    /**
     * The Method is Get Hot Houses
     * @Yuan1998
     * @DateTime 2018-02-03T20:04:01+0800
     * @return   [type]                   [description]
     */
    public function getHotHouse()
    {
        $r = $this->model->where('status','sell')->paginate(6);

        return $this->resultReturn($r);
    }


    /**
     * The Method is Get All Audit House Count.
     * @Yuan1998
     * @DateTime 2018-02-06T22:01:54+0800
     * @return   [type]                   [description]
     */
    public function getAuditCount()
    {
        $r = $this->model->where('status','audit')->count();

        return $this->resultReturn($r);
    }

    /**
     * The Method Is Get All Selling House Count ;
     * @Yuan1998
     * @DateTime 2018-02-06T22:03:09+0800
     * @return   [type]                   [description]
     */
    public function getSellingCount()
    {
        $r = $this->model->where('status','sell')->count();

        return $this->resultReturn($r);
    }


    /**
     * The Method is Get status is Audit houses on the page
     * @Yuan1998
     * @DateTime 2018-02-06T22:07:19+0800
     * @return   [type]                   [description]
     */
    public function getAuditHouse()

    {
        $r = $this->model->where('status','audit')->paginate(6);

        return $this->resultReturn($r);
    }


    /**
     * The Method Is Get Status is Sell Houses
     *
     * @Yuan1998
     * @DateTime 2018-02-02T22:48:47+0800
     * @return   [type]                   [description]
     */
    public function getSellHouse()
    {
        $r =$this->model->where('status','sell')->paginate(6);
        return $this->resultReturn($r);
    }

    /**
     * The Method is Get 6 houses.
     *
     * @Yuan1998
     * @DateTime 2018-02-08T13:08:02+0800
     * @return   [type]                   [description]
     */
    public function getAllHouse()
    {

        $r = $this->model->paginate(6);

        return $this->resultReturn($r);

    }

    /**
     * The method is admin get house info api.
     * @Yuan1998
     * @DateTime 2018-02-07T16:13:02+0800
     * @return   [type]                   [description]
     */
    public function getHouseInfo()
    {
        $id = request('id');
        $r = $this->model->find($id);
        return $this->resultReturn($r);
    }


    /**
     * The Method is Admin Chnage House Data Api.
     * @Yuan1998
     * @DateTime 2018-02-07T22:53:27+0800
     * @return   [type]                   [description]
     */
    public function houseEdit()
    {
        $data = request()->toArray();
        $id = $data['id'];
        $house = $this->model->find($id);
        if(in_array('location_info',$data))
            $data['location_info'] = $data['location_info'] ?: [];
        $r = $house->fill($data)->save();
        return $this->resultReturn($r);
    }

    /**
     * The Method is close House Api.
     * @Yuan1998
     * @DateTime 2018-02-07T23:07:58+0800
     * @return   [type]                   [description]
     */
    public function closeHouse()
    {
        $id = request('id');
        $house =$this->model->find($id);
        $house->status = 'close';
        $r = $house->save();
        return $this->resultReturn($r);

    }


    /**
     * The Method is Admin add House.
     *
     * @Yuan1998
     * @DateTime 2018-02-08T13:48:44+0800
     */
    public function addHouse()
    {
        $data = request()->toArray();
        $r = $this->model->create($data);
        return $this->resultReturn($r);
    }


    /**
     * 根据经纬度获取附近10000米在售的房子
     * @Yuan1998
     * @DateTime 2018-02-09T14:24:57+0800
     * @return   Array                   结果数组
     */
    public function getLngLat()
    {



        $lng = request('lng');
        $lat = request('lat');

        $rand = request('rand');

        $bounds = request('bounds');

        if(!$bounds){
            $bounds = $this->calcScope($lat,$lng,25000);
        }

        $max = $bounds['max'];
        $min = $bounds['min'];

        $r = $this->model
                ->select(
                    '*',
                    DB::raw("round(6378.138*2*asin(sqrt(pow(sin(
($lat*pi()/180-JSON_EXTRACT(location_info, '$.lat')*pi()/180)/2),2)+cos($lat*pi()/180)*cos(JSON_EXTRACT(location_info, '$.lat')*pi()/180)*
pow(sin( ($lng*pi()/180-JSON_EXTRACT(location_info, '$.lng')*pi()/180)/2),2)))*1000) as distance")
                )
                ->whereBetween('location_info->lng',[floatval($min['lng']),floatval($max['lng'])])
                ->whereBetween('location_info->lat',[floatval($min['lat']),floatval($max['lat'])])
                ->where('status','sell')
                // ->orderBy('distance','asc')
                // ->inRandomOrder()  // Rand result
                ->orderBy(DB::raw("RAND($rand)"))
                ->paginate(18);

        return $this->resultReturn($r);

    }

        /**
     * 根据经纬度和半径计算出范围
     * @param string $lat 经度
     * @param String $lng 纬度
     * @param float $radius 半径
     * @return Array 范围数组
     */
    private function calcScope($lat, $lng, $radius) {


        $degree = (24901*1609)/360.0;
        $dpmLat = 1/$degree;

        $radiusLat = $dpmLat*$radius;
        $minLat = $lat - $radiusLat;       // 最小经度
        $maxLat = $lat + $radiusLat;       // 最大经度

        $mpdLng = $degree*cos($lat * ($this->oPi));
        $dpmLng = 1 / $mpdLng;
        $radiusLng = $dpmLng*$radius;
        $minLng = $lng - $radiusLng;      // 最小纬度
        $maxLng = $lng + $radiusLng;      // 最大纬度

        /** 返回范围数组 */


        return [
            'max'=>['lng'=>$maxLng,'lat'=>$maxLat],
            'min'=>['lng'=>$minLng,'lat'=>$minLat],
        ];
    }

    /**
     * 复制数据
     * @Yuan1998
     * @DateTime 2018-02-20T17:25:01+0800
     * @return   [type]                   [description]
     */
    public function copyHouse()
    {
        $id = request('id');
        $count = request('count') ?: 1;

        $arr = [];
        for($i = 0;$i<$count;$i++){
            $clone = $this->model->find($id)->replicate();
            $location =$clone->location_info;

            $lng = request('lng') ?: $location['lng'];
            $lat = request('lat') ?: $location['lat'];

            $location['lng'] = $lng + ((mt_rand() / mt_getrandmax()) - 0.5) * 0.19;
            $location['lat'] = $lat + ((mt_rand() / mt_getrandmax()) - 0.5) * 0.19;
            $clone->location_info = $location;
            array_push($arr,$clone->save());
        }



        // dd();

// [121.5273285 + , 31.21515044 + (Math.random() - 0.5) * 0.02]
        return $arr;

    }



}
