<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Language extends Model
{
    public $table = "user_languages";

    protected $fillable = [
        'id',
        'name',
        'is_default',
        'code',
        'rtl',
        'user_id',
        'keywords'
    ];

    public function services(){
        return $this->hasMany('App\Models\User\UserService','lang_id')->where('user_id',Auth::id());
    }
    public function testimonials(){
        return $this->hasMany('App\Models\User\UserTestimonial','lang_id')->where('user_id',Auth::id());
    }
    public function blogs(){
        return $this->hasMany('App\Models\User\Blog')->where('user_id',Auth::id());
    }
    public function blog_categories(){
        return $this->hasMany('App\Models\User\BlogCategory')->where('user_id',Auth::id());
    }
    public function skills(){
        return $this->hasMany('App\Models\User\Skill')->where('user_id',Auth::id());
    }
    public function achievements(){
        return $this->hasMany('App\Models\User\Achievement')->where('user_id',Auth::id());
    }
    public function portfolios(){
        return $this->hasMany('App\Models\User\Portfolio')->where('user_id',Auth::id());
    }
    public function portfolio_categories(){
        return $this->hasMany('App\Models\User\PortfolioCategory')->where('user_id',Auth::id());
    }
    public function job_experiences(){
        return $this->hasMany('App\Models\User\JobExperience','lang_id')->where('user_id',Auth::id());
    }
    public function seos(){
        return $this->hasMany('App\Models\User\Seo','language_id')->where('user_id',Auth::id());
    }
    public function home_page_texts(){
        return $this->hasMany('App\Models\User\HomePageText','language_id')->where('user_id',Auth::id());
    }
    public function educations(){
        return $this->hasMany('App\Models\User\Education','lang_id')->where('user_id',Auth::id());
    }

}
