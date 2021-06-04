<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false; 
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'balance',
        'role',
        'experience',
        'picture_path',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function positions(){
        return $this->belongsTo(Position::class);
    }

    public function team(){
        return $this->hasMany(Team::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }
}
