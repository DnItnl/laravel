<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model// extends Authenticatable
{
    use HasFactory;//, Notifiable;
    protected $table = 'users';



    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    // protected $primaryKey = 'id';



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */




    protected $fillable = [
        'username',
        'email',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_user', 'user_id', 'room_id');
    }
    public function ownedRooms()
    {
        return $this->hasMany(Room::class, 'host_id');
    }

}
