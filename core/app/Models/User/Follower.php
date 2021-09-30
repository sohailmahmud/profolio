<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public $table = "followers";

    protected $fillable = [
        'follower_id',
        'following_id'
    ];

}
