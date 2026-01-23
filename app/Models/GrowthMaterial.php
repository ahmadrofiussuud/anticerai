<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type', // 'video' or 'article'
        'url',
        'thumbnail_url',
        'description',
        'subtitle', 
        'duration', // for videos
        'views', // for videos
        'category',
    ];
}
