<?php
namespace App;
use App\UserPermissions as User;

class SessionUser extends User
{


    /**
     * The Func is Set User Data.
     * @Yuan1998
     * @DateTime 2018-01-24T15:23:35+0800
     */
    public function set_data()
    {

        $data = $this->data;

        array_set($data,$key,$value);

        $this->data = $data;

        $this->save();

    }



    /**
     * The is get User Data Func
     * @Yuan1998
     * @DateTime 2018-01-24T15:24:07+0800
     * @param    String                  $key Get Data Keyword.default is false.
     * @return   Array                        if Keyword Exists,return correspond data. not Keyword return All Data.
     *
     */
    public function get_data($key=false)
    {

        if($key === 'user'){
            $data = $this->toArray();
            unset($data['data'],$data['logs']);
        }else{
            $data = $this->data;
        }

        $A = (new \CustomHelp\HelpArray($data));
        // dd(($key !== 'user') && ($key)); // false;
        return (($key !== 'user') && ($key)) ? $A->_get($key) : $A;
    }



    /**
     * Status Func. find user
     * @Yuan1998
     * @DateTime 2018-01-24T15:27:03+0800
     * @param    String                   $id User ID.
     * @return   Array                       Find result.
     */
    public static function findUser($id)
    {
        return self::where('id',$id)->first();
    }




    /**
     * add one log.
     *
     * @Yuan1998
     * @DateTime 2018-01-24T15:28:01+0800
     */
    public function addLog()
    {

        $logs = $this->logs ?: [];

        $logs[] = generateLog();

        $this->logs = $logs;

        $this->save();
    }


}

 ?>
