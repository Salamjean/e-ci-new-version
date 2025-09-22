<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class DHLAgence extends Authenticatable
{
    protected $table = 'd_h_l_agences';
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'password',
        'profile_picture',
        'commune',
        'archived_at',
        'disponible',
        'dhl_id ',
    ];

    
    public function scopeActive($query)
    {
        return $query->where('name', 'actif');
    }

    public function dhl()
    {
        return $this->belongsTo(Dhl::class); // Associe à la table users
    }
}
