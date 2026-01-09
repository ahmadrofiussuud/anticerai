<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couple extends Model
{
    use HasFactory;

    protected $fillable = [
        'husband_id',
        'wife_id',
        'pairing_code',
        'anniversary_date',
    ];

    protected $casts = [
        'anniversary_date' => 'date',
    ];

    public function husband()
    {
        return $this->belongsTo(User::class, 'husband_id');
    }

    public function wife()
    {
        return $this->belongsTo(User::class, 'wife_id');
    }
}
