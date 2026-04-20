<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'position',
        'location',
        'year',
        'duration',
        'responsibilities',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'responsibilities' => 'array',
    ];
}