<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name', 'nim', 'title', 'about',
        'email', 'phone', 'location',
        'github', 'instagram', 'photo',
    ];

    protected $table = 'profiles';
}
