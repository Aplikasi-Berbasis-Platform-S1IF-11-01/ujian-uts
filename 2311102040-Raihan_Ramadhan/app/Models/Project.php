<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'type', 'description', 'image',
        'github_url', 'demo_url', 'tech_stack', 'sort_order', 'is_featured',
    ];

    protected $casts = ['is_featured' => 'boolean'];

    public function getTechArrayAttribute(): array
    {
        return array_map('trim', explode(',', $this->tech_stack));
    }
}