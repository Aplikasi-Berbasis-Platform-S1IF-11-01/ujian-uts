<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'tech_stack', 'url', 'image', 'sort_order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    protected $table = 'projects';
}
