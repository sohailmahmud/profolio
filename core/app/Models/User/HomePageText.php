<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class HomePageText extends Model
{
    public $table = "user_home_page_texts";
    protected $fillable = [
        "about_image",
        "about_keyword",
        "about_title",
        "technical_image",
        "technical_keyword",
        "technical_title",
        "technical_content",
        "service_keyword",
        "service_title",
        "experience_keyword",
        "experience_title",
        "achievement_image",
        "achievement_keyword",
        "achievement_title",
        "portfolio_keyword",
        "portfolio_title",
        "testimonial_keyword",
        "testimonial_title",
        "blog_keyword",
        "blog_title",
        "get_in_touch_keyword",
        "get_in_touch_title",
    ];
    public function language() {
        return $this->belongsTo('App\Models\User\Language','language_id');
    }
}
