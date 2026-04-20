<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'description', 'tech_stack'])]
class Project extends Model
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'tech_stack' => 'array',
    ];
}
