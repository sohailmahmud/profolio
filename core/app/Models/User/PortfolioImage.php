<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $table = 'user_portfolio_images';
    public $timestamps = false;

    public function portfolio() {
        return $this->belongsTo('App\Models\User\Portfolio', 'user_portfolio_id');
    }
}
