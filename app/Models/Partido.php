<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'fecha',
        'hora',
        'lugar',
        'coste_pista',
        'cancelado',
        'goles_equipo',
        'goles_rival',
        'cronica_cerrada'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuarios()
    {
        // Hemos quitado 'rol' de aquí. Solo necesitamos 'goles'
        return $this->belongsToMany(User::class, 'partido_user')
                    ->withPivot(['goles']) 
                    ->withTimestamps();
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}