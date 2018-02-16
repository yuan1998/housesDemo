<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session;
use Storage;


use Validator;

class ApiController extends Controller
{
    //
    protected $model;


    private $error;


    public function add()
    {

        if(!$this->vaildator($this->model->createRules))
            return $this->getError();

        $r = $this->model->create(request()->toArray());


        return $r ? suc($this->model->id) :err('error');
    }



    public function remove()
    {

        $r = $this->model->where(request('id'))->delete();

        return $r ? suc() : err();
    }


    public function getCount()
    {
        return suc($this->model->count());
    }


    public function validator($rules,$data = null)
    {

        // get data
        if(!$data){
            $data = $this->filterData(request()->toArray());
        }

        $v = Validator::make($data,$rules);

        if($v->fails())
        {
            $this->error = $v->errors();
            return false;
        }

        return $data;
    }


    public function getError()
    {
        return err($this->error);
    }


    public function read()
    {
        $r = $this->model->get();
        return $r !== false? suc($r) : err('error');
    }

    protected function filterData($data)
    {
        // get table all column name
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($this->model->table);

        foreach($data as $key=>$value){
            if(!in_array($key,$columns))
                unset($data[$key]);
        }
        return $data;
    }

    public static function resultReturn($r,$type=null)
    {
        return $r !== false ? suc($r) : err('error');
    }


    /**
     * The Method is Change Table in One Row.
     * @Yuan1998
     * @DateTime 2018-01-31T17:07:08+0800
     * @param    [type]                   $id  [description]
     * @param    [type]                   $who [description]
     * @param    [type]                   $to  [description]
     * @return   [type]                        [description]
     */
    public function changeColumn($id,$who,$to)
    {
      return $this->model->where('id',$id)->update([$who=>$to]);

    }


    /**
     * The Method is save Message Text
     * @Yuan1998
     * @DateTime 2018-01-31T17:06:40+0800
     * @return   [type]                   [description]
     */
    protected function saveText()
    {
      $mText =  '\App\Http\Controllers\MessageTextController';

      return (new $mText)->saveMessageContent();
    }


    /**
     * The Method is Parse Base64 File And Save
     * @Yuan1998
     * @DateTime 2018-01-31T17:05:24+0800
     * @param    String                   $imgstr  Base64 String
     * @return   [type]                           [description]
     */


    public function parseBase64($imgstr)
    {

        $new_data = explode(";",$imgstr);

        $type= explode("/",$new_data[0])[1];

        $img= explode(",",$new_data[1])[1];

        $fileName = self::createFileName($type);

        $data = base64_decode($img);

        $r = Storage::disk('public')->put($fileName,$data);

        return $r ? ['name'=>$fileName,'type'=>$type,'size'=>$r,'url'=>url("/storage/$fileName"),'get'=>url("/api/img/?file=$fileName")] : false;
    }

    public static function createFileName($ext)
    {
      return date('Y-m-d-H-i-s') .'-'. rand(1010,2020). uniqid() .'.'. $ext;
    }


    /**
     * The Method is Parse Base64 Arr Data.
     * @Yuan1998
     * @DateTime 2018-01-31T17:04:23+0800
     * @param    Array                   $arr  Base64 in the Array
     * @return   [type]                        [description]
     */
    public function parseArrBase64($arr)
    {
        $nArr = [];

        foreach($arr as $key=>$value){
            $nArr[$key] = [];
            foreach($value as $item){
                array_push($nArr[$key], $this->parseBase64($item));
            }
        }

        return $nArr;
    }


    /**
     * The method is remove file in the Storage.
     * @Yuan1998
     * @DateTime 2018-01-31T17:03:31+0800
     * @param    String                   $name  File Name
     * @return   [type]                         [description]
     */
    public function removeFile($name)
    {

        return Storage::disk('public')->delete($name);

    }

}
