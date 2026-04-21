<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'nim', 'jurusan', 'title', 'tagline', 'bio', 'about',
        'email', 'phone', 'location', 'github', 'linkedin', 'instagram',
        'website', 'photo', 'years_experience', 'projects_done', 'clients',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        return asset('storage/' . $this->photo);
    }
}
