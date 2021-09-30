<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    public $table = "user_skill_categories";

    protected $fillable = [
        "language_id",
        "name",
        "status",
        "serial_number",
        "user_id",
    ];

    public function skills() {
        return $this->hasMany('App\Models\User\Skill','category_id');
    }
}
