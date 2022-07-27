<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCobroGarita extends Model
{
    use HasFactory;

    protected $table    = 'historial_cobros_garita';

    protected $fillable = [
        'idUsuarioCreacion',
        'fechaInicio',
        'fechaFin',
        'observacionCierre',
        'valorRecaudado',
        'cerrado',
        'activo'
    ];

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }

}
