<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
