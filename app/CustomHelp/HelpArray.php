<?php

namespace CustomHelp;



class HelpArray
{


   public function __construct($data){

      $this->fill($data);
   }

   public function fill($data)
   {
      foreach($data as $key=>$value){
         $this->$key = $value;
      }
   }

   public function _get($key)
   {

      return array_get($this,$key);

   }

   public function toArray()
   {

      return (array)$this;

   }

   public function forget($key)
   {
      if(isset($this->$key)){
         unset($this->$key);
         $SY = newSession()->saveData($this->toArray());
      }
      return $this;

   }

   public function _has($key)
   {
      return isset($this->$key);
   }

   public function _all($arr)
   {

      $a = $this->toArray();

      if(!$a)
         return null;

      if(is_array($arr)){
         $r = [];
         foreach($arr as $value){
            if(isset($a[$value]))
               $r[$value] = $a[$value];
         }
         return $r;
      }else{
         return $a[$arr] ?: null;
      }

   }

}
