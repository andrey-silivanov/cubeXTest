<?php
declare (strict_types = 1);

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    //
//    protected $table = 'roles';
//    public function users(){
//        return $this->belongsToMany('App\Models\User','role_user','role_id','user_id');
//    }
}
