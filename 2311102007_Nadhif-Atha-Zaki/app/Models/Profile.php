<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'full_name',
        'nim',
        'study_program',
        'title',
        'short_bio',
        'about_me',
        'photo',
        'email',
        'instagram',
        'github',
    ];
}