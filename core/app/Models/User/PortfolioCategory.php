<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    public $table = "user_portfolio_categories";

    protected $fillable = [
        "language_id",
        "name",
        "status",
        "serial_number",
        "user_id",
    ];

    public function portfolios() {
        return $this->hasMany('App\Models\User\Portfolio','category_id');
    }
}
