<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['institution', 'major', 'degree', 'year_start', 'year_end', 'description', 'sort_order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    protected $table = 'educations';
}
