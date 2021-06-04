<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false; 
    protected $fillable = [
        'id',
        'name'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
