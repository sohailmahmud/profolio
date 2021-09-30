<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = [
    'name',
    'permissions',
];

    public function admins() {
      return $this->hasMany('App\Models\Admin');
    }
}
