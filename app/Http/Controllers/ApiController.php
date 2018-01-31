<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session;


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

    public function resultReturn($r,$type=null)
    {
        return $r !== false ? suc($r) : err('error');
    }

    public function changeColumn($id,$who,$to)
    {
      return $this->model->where('id',$id)->update([$who=>$to]);

    }

    protected function saveText()
    {
      $mText =  '\App\Http\Controllers\MessageTextController';

      return (new $mText)->saveMessageContent();
    }

    public function parseBase64($imgstr)
    {

        $new_data=explode(";",$imgstr);

        $type= explode("/",$new_data[0])[1];

        $img= explode(",",$new_data[1])[1];

        $path = base_path()."/public/storage/img/";

        $fileName =   uniqid().time().'.' .$type;

        $data = base64_decode($img);

        $r = file_put_contents($path.$fileName, $data);

        return $r ? ['name'=>$fileName,'type'=>$type,'size'=>$r] : false;
    }

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

}
