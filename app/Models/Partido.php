<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partidos';
    
    protected $fillable = [
        'equipo_id', 
        'fecha', 
        'hora', 
        'lugar', 
        'coste_pista', 
        'cancelado'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'partido_user')
                    ->withPivot('asistencia', 'pagado', 'goles', 'asistencias')
                    ->withTimestamps();
    }
}