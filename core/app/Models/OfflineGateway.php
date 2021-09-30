<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfflineGateway extends Model
{
    protected $fillable = ['id', 'name', 'short_description', 'instructions', 'serial_number', 'status', 'is_receipt', 'receipt'];
}
