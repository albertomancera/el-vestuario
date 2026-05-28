<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // Los campos que permitimos guardar masivamente
    protected $fillable = [
        'partido_id',
        'user_id',
        'mensaje',
    ];

    // Relación: Un comentario pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un comentario pertenece a un partido
    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }
}