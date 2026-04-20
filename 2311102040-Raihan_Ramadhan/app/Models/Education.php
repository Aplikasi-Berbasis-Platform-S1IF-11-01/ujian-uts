<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['degree', 'school', 'year_start', 'year_end', 'sort_order'];
    protected $table = 'educations';
}