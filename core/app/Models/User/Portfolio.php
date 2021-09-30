<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public $table = "user_portfolios";
    protected $fillable = [
        "title",
        "slug",
        "image",
        "content",
        "serial_number",
        'featured',
        "language_id",
        "category_id",
        "user_id",
        "meta_keywords",
        "meta_description",
    ];

    public function bcategory() {
        return $this->belongsTo('App\Models\User\PortfolioCategory','category_id');
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function portfolio_images()
    {
        return $this->hasMany('App\Models\User\PortfolioImage', 'user_portfolio_id');
    }
}
