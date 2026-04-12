<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Terrain;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\Annonce;
use App\Models\Participation;
use App\Models\Avis;
use App\Models\Blocage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'latitude', 
        'longitude',
        'pointsCompte', 
        'stripe_id',
        'estApprouve',
        'estActif',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'estActif'    => 'boolean',
        'estApprouve' => 'boolean',
        'pointsCompte'=> 'decimal:2',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole(string $titre)
    {
        return $this->roles->contains('titre', $titre);
    }

    public function isAdmin()       
    { 
        return $this->hasRole('admin'); 
    }

    public function isModerateur()
    { 
        return $this->hasRole('moderateur'); 
    }

    public function isJoueur()  
    { 
        return $this->hasRole('joueur'); 
    }

    public function terrains()
    {
        return $this->hasMany(Terrain::class, 'moderateur_id');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function annonces()
    {
        return $this->hasMany(Annonce::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function blocagesEffectues()
    {
        return $this->hasMany(Blocage::class, 'moderateur_id');
    }

    public function blocagesRecus()
    {
        return $this->hasMany(Blocage::class, 'joueur_id');
    }

    public function estBloqueeSur(int $terrainId)
    {
        return $this->blocagesRecus()
            ->where('terrain_id', $terrainId)
            ->exists();
    }
}
