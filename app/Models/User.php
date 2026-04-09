<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Terrain;
use App\Models\Reservation;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'estApprouve',
        'estActif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function terrains()
    {
        return $this->hasMany(Terrain::class, 'moderateur_id');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class, 'member_id');
    }

    public function mesNotifications() 
    {
        return $this->hasMany(Notification::class, 'user_id')->latest();
    }
}
