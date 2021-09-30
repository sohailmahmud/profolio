<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
    protected $fillable = ['sitemap_url','filename'];
    protected $table    = 'sitemaps';

}
