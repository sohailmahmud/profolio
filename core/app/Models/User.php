<?php

namespace App\Models;

use App\Notifications\UserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Controller;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'photo',
        'username',
        'password',
        'phone',
        'city',
        'state',
        'address',
        'country',
        'status',
        'featured',
        'verification_link',
        'email_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function memberships() {
        return $this->hasMany('App\Models\Membership','user_id');
    }

    public function permissions(){
        return $this->hasOne('App\Models\User\UserPermission','user_id');
    }

    public function basic_setting(){
        return $this->hasOne('App\Models\User\BasicSetting','user_id');
    }

    public function portfolios(){
        return $this->hasMany('App\Models\User\Portfolio','user_id');
    }

    public function portfolioCategories(){
        return $this->hasMany('App\Models\User\PortfolioCategory','user_id');
    }

    public function skills(){
        return $this->hasMany('App\Models\User\Skill','user_id');
    }

    public function achievements(){
        return $this->hasMany('App\Models\User\Achievement','user_id');
    }

    public function services(){
        return $this->hasMany('App\Models\User\UserService','user_id');
    }

    public function seos(){
        return $this->hasMany('App\Models\User\SEO','user_id');
    }

    public function testimonials(){
        return $this->hasMany('App\Models\User\UserTestimonial','user_id');
    }

    public function blogs(){
        return $this->hasMany('App\Models\User\Blog','user_id');
    }

    public function blog_categories(){
        return $this->hasMany('App\Models\User\BlogCategory','user_id');
    }

    public function social_media(){
        return $this->hasMany('App\Models\User\Social','user_id');
    }

    public function job_experiences(){
        return $this->hasMany('App\Models\User\JobExperience','user_id');
    }

    public function educations(){
        return $this->hasMany('App\Models\User\Education','user_id');
    }

    public function permission(){
        return $this->hasOne('App\Models\User\UserPermission','user_id');
    }

    public function languages(){
        return $this->hasMany('App\Models\User\Language','user_id');
    }

    public function home_page_texts(){
        return $this->hasMany('App\Models\User\HomePageText','user_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $username = User::query()->where('email',request()->email)->pluck('username')->first();
        $subject = 'You are receiving this email because we received a password reset request for your account.';
        $body = "Recently you tried forget password for your account.Click below to reset your account password.
             <br>
             <a href='".url('password/reset/'.$token .'/email/'.request()->email)."'><button type='button' class='btn btn-primary'>Reset Password</button></a>
             <br>
             Thank you.
             ";
        $controller = new Controller();
        $controller->resetPasswordMail(request()->email,$username,$subject,$body);
        session()->flash('success', "we sent you an email. Please check your inbox");
    }

}
