<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',  
        'source_id', 
        'source_type', 
        'lu_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function source() {
        return $this->morphTo();
    }    
}
