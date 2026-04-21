<?php
// app/Models/Profile.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model {
    protected $fillable = ['name','initials','role','tagline','bio','location','available','photo_url','stats'];
    protected $casts = ['available' => 'boolean'];
}