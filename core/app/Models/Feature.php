<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "language_id", 
        'icon',
        'title',
        'serial_number',
       ];



    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
