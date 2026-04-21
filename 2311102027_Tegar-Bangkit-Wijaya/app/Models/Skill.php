<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name', 'category', 'level', 'icon', 'color', 'order', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'level'       => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
