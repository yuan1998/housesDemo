<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ApiController extends Controller
{
    //
    protected $model;


    private $error;


    public function __construct($model)
    {

    	$model = "\App\\${model}";


    	$this->model = new $model;
    }


    public function add()
    {

        if(!$this->vaildator($this->model->createRules))
            return $this->getError();

        $r = $this->model->create(request()->toArray());


    	return $r ? suc($this->model->id) :err('error');    	
    }


    public function change()
    {

    	$r = $this->model->where(request('id'))->update(request()->toArray());

    	return $r ? suc() : err();
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
        $data = $this->filterData($data ?: request()->toArray());


        $v = Validator::make($data,$rules);

        if($v->fails())
        {
            $this->error = $v->errors();
            // dd($this->error);
            return false;
        }
        return $data;

    	// return request()->validate($rules);
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
}
