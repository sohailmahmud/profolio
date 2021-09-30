<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserTestimonial extends Model
{
    public $table = "user_testimonials";
    protected $fillable= [
        'image',
        'occupation',
        'name',
        'content',
        'serial_number',
        'user_id',
        'lang_id'
    ];
    public function language() {
        return $this->belongsTo(Language::class,'lang_id');
    }
}
