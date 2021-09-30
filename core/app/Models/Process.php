<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
