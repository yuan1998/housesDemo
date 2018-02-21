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


        $titles = [
            'Designer Loft Bangkok Silom',
            '地理位置便利,1 分钟可达 BTS 空铁,提供 WiFi',
            '3BR Suite 146sqm BTS Thonglo',
            'GARDEN IN BANGKOK B&B',
            '5分钟到旺角!新装宽敞的房间! New & Cozy Rm! 5mins to Mongkok !4',
            'New & Comfy Private Room for Single Traveler @TST',
            '香港 Hong Kong 長洲 Cheung Chau lsland',
            'Bunk Bed Room #10 Tsim Sha Tsui MTR Exit B1',
            '性價比高舒適安全的房間 - 只限女生',
            '5分钟到旺角!新装宽敞的房间! New & Cozy Rm! 5mins to Mongkok !5',
            'Private OpenStudio w/ terrace @ Mid-Levels Central',
            '双人床房间,步行十多步到地铁站、巴士站,能说普通话、广东话和英语。',
            'Cozy Twin Room@Mong Kok City Centre 旺角區舒適標雙房',
            '单人床房间,步行十多步到地铁站、巴士站,能说普通话、广东话和英语。',
            '★7)Hot Deal! 1min from Tsim Sha Tsui metro',
            'Cebu Hotel Deluxe Single Room #2 Ensuite Bathroom',
            '(808) Double bed with ensuite bath - 3 mins mTR',
            '市中心三大商业广场环绕,独立房间超大2米床',
            '广州南沙区三民岛/百万园/19冲湿地公园',
            '趣舍,市中心科大,独立院落Loft别墅中的一间,共5间,全部独立卫生间',
            '回到家的感觉',
            '长江水世界旁 高尔夫花园 北欧风格三居 万科柏悦湾桃源居 comfy home away home',
            '设计师之家/日式大户型/拍照佳景(两房) Designers ( Home2 bedrooms )',
            'Perry的舒适大床房',
            '中山东区全新日式+欧式家庭公寓',
            '婚房！婚房！结婚啦！有了她就有可以有老婆了！视野好',
            '离梦想很近，实现舒适三房奢华生活，新婚首选',
            '精致三房，尚的装修风格，婚房优选',
            '13年在观望，14年在观望！15年您还在观望么？机会只有一次！',
            '120万买一套数一数二的学区房，还等什么？',
            '观望是没有结果的，该出手时就出手，这才是硬道理！',
            '送阁楼，相信独具慧眼的您会买就会赚，仅此一套！',
            '投资少，回报高的性价好房出售！',
            '忍痛急售！！XX对面即将拆迁的房子，拆迁后绝对赚到！',
            '什么叫真正特价房看看这套你会明白！急售',
            '好的房子不是用来欣赏的是用来享受的！！！',
            '政策来了您犹豫了，低价房来了您心动吗？',
            '带实验小学名额，别让我们孩子输在起跑线上',
            '精致户型，享受无限阳光生活。',
            '精品学区房！低价急售！广场规划中!各自付税！',
            '全明户型，黄金楼层阳光好，交通便利，设施齐全',
            '双学区！豪装好楼层！三房无税好房',
            '优质学区，尽可享受优质的教育。',
            '经典三房！东边户型！全明！精装修！两证齐全！',
            '新+阳光+好户型+双南全明+靠近XX公园',
            '高档小区人文荟萃高品质的象征豪华婚装！',
            '震撼价！阳光城，精装新房卖毛坯价，要买快来看！',
            '精品好房，适合年经人首次购房，总价低',
            '真正的景观好房动静结合悠然自得！！！',
            '实木地板三房无税！楼层好超低价交通便利',
            '反季节买带暖气好房，图的就是性价比好',
            '立体交通全程对接，主城生活唾手可得',
            '多维度交通，10分钟到地铁，大型超市旁'
        ];


        $communitys = [
            '帕特万',
            '拉敏特拉',
            '某某厂居民小区',
            '幸福小区',
            '燕园',
            '长乐渡',
            '幸福里9号',
            '诗房村',
            '清华园 ',
            '和风细宇',
            '金成维也纳',
            '金成维也纳春天',
            '御墅邻峰',
            '君悦海棠',
            '塞纳河畔',
            '山水天域',
            '爱情公寓',
            '紫崧枫林上城',
            '南湖清水世家',
            '海上五月花',
            '爱佳798',
            '格林小城',
            '巴塞玫瑰城',
            '中央华府',
            '都市家园',
            '梧桐树下',
            '佳境天城',
            '汾水尚苑',
            '梅苑小区',
            '高巢',
            '金汇花园',
            '新明星花园',
            '白玉兰花园',
            '莫奈印象'
        ];

        $covers = [
            'cover_1.jpg',
            'PH_case-study-perpetuum-smart-home.jpg',
            'Vantage Rotator.jpg',
            'MaxHan.jpg',
            'home-design-contemporary2.jpg',
            'slide3.jpg',
            'hem-home-002.jpg',
            'coolum_geneva-facade-copy.jpg',
            'ihg-home-brand-gallery-cv.jpeg',
            '56587_11491_001.jpg',
            'adina-melbourne-flinders-street-apartment-hotel-one-and-two-bedroom-apartment-2-2013.jpg',
            'upscale.jpg',
            'feat4.jpg',
            'architecture-modern-apartment-1-850x450.jpg',
            '16210D02.jpg',
            'first-home-starter-home-mst.jpg',
            'open-concept-japanese-family-home-with-domed-interior-1-night-lighting.jpg',
        ];


        $arr = [];
        for($i = 0;$i<$count;$i++){
            $clone = $this->model->find($id)->replicate();

            $image = $clone->house_img;

            $location =$clone->location_info;

            $fileName = $covers[rand(0, count($covers) - 1)];

            $clone->title = $titles[rand(0,count($titles) - 1)];

            $clone->community = $communitys[rand(0,count($communitys) - 1)];
            $clone->price = rand(100,9999);

            $image['cover'] = [[
                            'name'=>$fileName,
                            'type'=>'jpg',
                            'size'=>true,
                            'url'=>url("/storage/$fileName"),
                            'get'=>url("/api/img/?file=$fileName")
                        ]];

            $lng = request('lng') ?: $location['lng'];
            $lat = request('lat') ?: $location['lat'];



            $location['lng'] = $lng + ((mt_rand() / mt_getrandmax()) - 0.5) * 0.19;
            $location['lat'] = $lat + ((mt_rand() / mt_getrandmax()) - 0.5) * 0.19;
            $clone->location_info = $location;
            $clone->house_img = $image;

            array_push($arr,$clone->save());
        }



        // dd();

// [121.5273285 + , 31.21515044 + (Math.random() - 0.5) * 0.02]
        return $arr;

    }



}
