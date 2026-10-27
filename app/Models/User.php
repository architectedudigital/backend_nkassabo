<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'indicatif_pays',
        'numero_telephone',
        'mot_de_passe',
        'a_une_candidature_existante',
        'numero_identifiant_parrain',
        'nom_parrain',
        'pdpl_accepte_le',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'pdpl_accepte_le' => 'datetime',
            'a_une_candidature_existante' => 'boolean',
            'mot_de_passe' => 'hashed',
        ];
    }

    /**
     * Indique à Laravel d'utiliser la colonne 'mot_de_passe' pour l'authentification.
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // --- Relations ---

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(UserAddress::class, 'user_id');
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class, 'user_id');
    }
}