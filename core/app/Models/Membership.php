<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public $table = "memberships";

    protected $fillable = [
        'price',
        'currency',
        'currency_symbol',
        'payment_method',
        'transaction_id',
        'status',
        'is_trial',
        'trial_days',
        'receipt',
        'transaction_details',
        'settings',
        'package_id',
        'user_id',
        'start_date',
        'expire_date',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
}
