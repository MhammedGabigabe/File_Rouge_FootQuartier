<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'type',
        'montant', 
        'points',
        'reference', 
        'statut',
        'transactionnable_id', 
        'transactionnable_type',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionnable()
    {
        return $this->morphTo();
    }
}
