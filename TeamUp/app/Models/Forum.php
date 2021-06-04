<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    public $incrementing = false; 
    public $timestamps = true;
    

    protected $fillable = [
        'id',
        'user_id',
        'team_id',
        'content'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function teams(){
        return $this->belongsTo(Team::class);
    }
}
