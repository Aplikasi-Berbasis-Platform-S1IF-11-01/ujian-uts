<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'tech_stack', 'demo_url',
        'github_url', 'thumbnail', 'status', 'year', 'order', 'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'tech_stack'  => 'array',
    ];

    public function getThumbnailUrlAttribute(): ?string
    {
        if (!$this->thumbnail) return null;
        if (str_starts_with($this->thumbnail, 'http')) return $this->thumbnail;
        return asset('storage/' . $this->thumbnail);
    }
}
