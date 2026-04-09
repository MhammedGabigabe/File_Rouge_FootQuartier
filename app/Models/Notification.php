<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'message',  
        'source_id', 
        'source_type', 
        'lu_at'];

    public function source() {
        return $this->morphTo();
    }    
}
