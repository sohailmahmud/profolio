<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $table = "user_educations";
    protected $fillable = [
        'degree_name',
        'slug',
        'short_description',
        'start_date',
        'end_date',
        'serial_number',
        'user_id',
        'lang_id'
    ];
}
