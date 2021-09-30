<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $table = "user_skills";
    protected $fillable = [
        "title",
        "slug",
        "percentage",
        "color",
        "serial_number",
        "language_id",
        "user_id",
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
