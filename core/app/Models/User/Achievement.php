<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $table = 'user_achievements';
    public $timestamps = false;
    protected $fillable = [
        "title",
        "serial_number",
        "language_id",
        "user_id",
        "count"
    ];

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
