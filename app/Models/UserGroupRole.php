<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroupRole extends Model
{
    protected $table = 'user_group_roles';
    use HasFactory;
    function user_group(){
        return $this->belongsTo(UserGroup::class, 'user_group_id', 'id');
    }
    function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
