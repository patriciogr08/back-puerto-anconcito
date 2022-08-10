<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'idTipo',
        'idPadre',
        'idUsuarioCreacion',
        'valor',
        'activo'
    ];


   /**
    * Relación Uno a Varios ( inversa )
    */
    public function padre() {
        return $this->belongsTo(Parametro::class, 'idPadre');
    }
    
    public function tipo() {
        return $this->belongsTo(Parametro::class, 'idTipo');
    }

    public function usuarioCreacion() {
        return $this->belongsTo(User::class, 'idUsuarioCreacion');
    }
}
