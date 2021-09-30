<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = true;

    protected $fillable = [
      "language_id", 
      "bcategory_id", 
      "title", 
      "slug", 
      "main_image", 
      "content", 
      "meta_keywords", 
      "meta_description", 
      "serial_number", 
     ];

    public function bcategory() {
      return $this->belongsTo('App\Models\Bcategory');
    }

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }
}
