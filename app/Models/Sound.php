<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'path',
        'sound_kit_id'
    ];

    public function soundKit()
    {
        return $this->belongsTo(SoundKit::class);
    }
}
