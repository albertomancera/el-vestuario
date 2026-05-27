<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    
    protected $fillable = [
        'nombre', 
        'escudo', 
        'codigo_invitacion'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'equipo_user')->withPivot('rol')->withTimestamps();
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}