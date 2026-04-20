<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['description', 'profile_picture', 'email', 'github', 'instagram', 'dribbble'];
}
