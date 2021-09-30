<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public $table = "user_contact_messages";

    protected $fillable = [
        'fullname',
        'email',
        'subject',
        'message',
        'user_id'
    ];
}
