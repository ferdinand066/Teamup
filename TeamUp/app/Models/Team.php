<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $incrementing = false; 
    protected $fillable = [
        'id',
        'creator_id',
        'name',
        'short_description',
        'full_description',
        'salary',
        'position_list',
        'address',
        'is_closed'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function members(){
        return $this->belongsToMany(User::class, 'team_details', 'team_id', 'user_id')
            ->withTimestamps()
            ->withPivot(['is_accepted', 'position_id']);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }


}
