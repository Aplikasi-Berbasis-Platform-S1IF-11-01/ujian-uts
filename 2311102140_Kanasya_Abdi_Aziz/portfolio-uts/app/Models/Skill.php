<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'category', 'level', 'icon', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }
}