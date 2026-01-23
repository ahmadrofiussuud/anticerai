<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'couple_id',
        'title',
        'description',
        'image_path',
        'memory_date',
        'tags',
    ];

    protected $casts = [
        'memory_date' => 'date',
        'tags' => 'array',
    ];

    public function couple()
    {
        return $this->belongsTo(Couple::class);
    }
}
