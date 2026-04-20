<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    protected $table = 'project_media';

    protected $fillable = [
        'project_id','type','role','path','provider','embed_id','url','poster_path',
        'width','height','aspect_ratio','caption','exif','sort_order',
    ];

    protected $casts = [
        'exif' => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}