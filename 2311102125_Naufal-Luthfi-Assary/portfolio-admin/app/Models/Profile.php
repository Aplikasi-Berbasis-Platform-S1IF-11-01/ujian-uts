<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'brand_name',
        'headline',
        'about',
        'domicile',
        'email',
        'career_interest',
        'languages',
        'photo',
        'hero_badge',
        'availability',
    ];
}