<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    public $table = "job_experiences";

    protected $fillable = [
        'company_name',
        'designation',
        'content',
        'start_date',
        'end_date',
        'is_continue',
        'serial_number',
        'lang_id',
        'user_id',
    ];
    public function language() {
        return $this->belongsTo(Language::class,'lang_id');
    }
}
