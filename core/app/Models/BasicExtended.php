<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicExtended extends Model
{

    protected $table = 'basic_extendeds';

        public $timestamps = false;

        public function language() {
            return $this->belongsTo('App\Models\Language');
        }
}
