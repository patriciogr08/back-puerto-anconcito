<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'apellidos',
        'nombres',
        'idTipoIdentificacion',
        'identificacion',
        'idUsuarioCreacion',
    ];

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }
}
