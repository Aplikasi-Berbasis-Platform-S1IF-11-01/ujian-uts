<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'about', 'email',
        'photo', 'instagram', 'linkedin', 'github',
    ];
}