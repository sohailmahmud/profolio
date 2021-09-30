<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['language_id', 'home_meta_keywords','home_meta_description','profiles_meta_keywords','profiles_meta_description','pricing_meta_keywords','pricing_meta_description','blogs_meta_keywords','blogs_meta_description','faqs_meta_keywords','faqs_meta_description','contact_meta_keywords','contact_meta_description', 'login_meta_keywords','login_meta_description','forget_password_meta_keywords','forget_password_meta_description','checkout_meta_keywords','checkout_meta_description'];
}
