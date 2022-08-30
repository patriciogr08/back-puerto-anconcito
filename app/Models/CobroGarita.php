<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobroGarita extends Model
{
    use HasFactory;

    protected $table    = 'cobros_garita';

    protected $fillable = [
        'idCliente',
        'idTipoVehiculo',
        'placaVehiculo',
        'valor',
        'fecha',
        'hora',
        'cerrado',
        'idUsuarioCreacion',
        'activo',
        'ticket'
    ];


    public function tipoVehiculo() {
        return $this->belongsTo(Parametro::class, 'idTipoVehiculo');
    }
    
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }
}
