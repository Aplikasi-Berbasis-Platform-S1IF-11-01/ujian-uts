<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'nim', 'class', 'tagline', 'description',
        'photo', 'email', 'github', 'instagram', 'location',
        'gpa', 'projects_count', 'tech_count', 'available',
    ];

    protected $casts = [
        'available' => 'boolean',
        'gpa'       => 'float',
    ];

    public static function getSingle(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'name'           => 'Your Name',
            'nim'            => '0000000000',
            'class'          => 'IF-00-00',
            'description'    => 'Deskripsi diri.',
            'gpa'            => 0,
            'projects_count' => 0,
            'tech_count'     => 0,
        ]);
    }
}