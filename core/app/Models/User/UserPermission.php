<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    public $table = "user_permissions";
    protected $fillable = [
        'permissions',
        'package_id',
        'user_id'
    ];
}
