<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ExperienceCategory extends Model
{
    public $table = "user_experience_categories";

    protected $fillable = [
        "language_id",
        "name",
        "status",
        "serial_number",
        "user_id",
    ];
}
