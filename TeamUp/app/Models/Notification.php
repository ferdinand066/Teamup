<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $incrementing = false; 
    protected $fillable = [
        'id',
        'user_id',
        'message'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
