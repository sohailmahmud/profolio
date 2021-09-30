<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public $table = "user_blog_categories";

    protected $fillable = [
        "language_id",
        "name",
        "status",
        "serial_number",
        "user_id",
    ];

    public function blogs() {
        return $this->hasMany('App\Models\User\Blog','category_id');
    }
    public function language() {
        return $this->belongsTo(Language::class,'language_id');
    }
}
