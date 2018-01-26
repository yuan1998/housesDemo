<?php
namespace App;
use App\User as User;

class UserPermissions extends User
{


   public function getPermission()
   {

      $permission = $this->permission;

      $r = $this->userPermissionList[$permission];

      return $r ?: null;

   }

   public function is_admin()
   {
      return ($this->permission >= 4);
   }

   public function is_user()
   {
      return ($this->permission >= 1);
   }

}

 ?>
