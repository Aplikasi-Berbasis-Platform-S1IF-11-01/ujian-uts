<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['nama', 'profesi', 'deskripsi', 'github_link', 'linkedin_link', 'foto'];
}