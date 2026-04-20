<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'name', 'subtitle', 'about_me', 'photo_url', 'email', 'phone', 'address', 'github_url', 'linkedin_url'
    ];
}
