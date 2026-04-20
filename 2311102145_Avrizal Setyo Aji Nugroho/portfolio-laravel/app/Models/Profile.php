<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'bio', 'email', 'phone',
        'location', 'github', 'linkedin', 'instagram',
        'whatsapp', 'photo', 'typed_words',
    ];

    protected $casts = [
        'typed_words' => 'array',
    ];
}
