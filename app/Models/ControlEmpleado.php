<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlEmpleado extends Model
{
    
    use HasFactory;

    protected $table    = 'control_empleados';

    protected $fillable = [
        'idEmpleado',
        'cv',
        'referencias',
        'renovacion',
        'mesesContrato',
        'fechaInicio',
        'fechaFin',
        'idUsuarioCreacion',
        'activo'
    ];

    public function empleado() {
        return $this->belongsTo(User::class, 'idEmpleado');
    }

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }


}
