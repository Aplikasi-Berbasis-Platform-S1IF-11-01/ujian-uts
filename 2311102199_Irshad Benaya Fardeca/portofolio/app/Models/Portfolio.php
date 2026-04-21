<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'title',
        'description',
        'profile_image',
        'email',
        'phone',
        'address',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'about_me'
    ];
}