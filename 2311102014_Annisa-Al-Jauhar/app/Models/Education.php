<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    
    protected $fillable = ['institution', 'degree', 'field', 'start_year', 'end_year', 'description', 'order'];
}
