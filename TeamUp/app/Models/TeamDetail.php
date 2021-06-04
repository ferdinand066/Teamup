<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'member_id',
        'position_id',
        'is_accepted'
    ];

    public function team(){
        return $this->belongsTo(Teams::class);
    }
    
}
