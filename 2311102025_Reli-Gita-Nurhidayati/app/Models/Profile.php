<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'nim', 'tagline', 'about',
        'university', 'major', 'location', 'focus',
        'email', 'linkedin', 'github', 'instagram',
        'photo', 'semester'
    ];
}