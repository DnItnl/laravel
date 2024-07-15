<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'host_id',
        'password',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
