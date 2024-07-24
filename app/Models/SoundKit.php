<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundKit extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon', 
        'name', 
        'author_id'
    ];

    public function sounds()
    {
        return $this->hasMany(Sound::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
