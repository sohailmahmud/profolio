<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    public $table = "user_services";
    protected $fillable= [
        'image',
        'slug',
        'name',
        'content',
        'serial_number',
        'featured',
        'detail_page',
        'user_id',
        'lang_id',
        'meta_keywords',
        'meta_description'
    ];

    public function language() {
        return $this->belongsTo(Language::class,'lang_id');
    }
}
