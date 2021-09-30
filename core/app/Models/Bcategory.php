<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bcategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
      "language_id", 
      "name", 
      "status", 
      "serial_number", 
     ];

    public function blogs() {
      return $this->hasMany('App\Models\Blog');
    }
}
