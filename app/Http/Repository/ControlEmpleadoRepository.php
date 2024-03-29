<?php

namespace app\Http\Repository;

use App\Models\ControlEmpleado;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControlEmpleadoRepository {

    public function all(){
        try {
            $contratos = ControlEmpleado::all();
           
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $contratos;
    }

    public function create($data){
        try {
            $data['idUsuarioCreacion'] = Auth::user()->id;
            $data = ControlEmpleado::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        $data->activo = true;
        return $data;
    }

    public function destroy($contolEmpleado)
    {
        try {
            $data = ['activo' => false];
            $contolEmpleado->update($data);
            
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $contolEmpleado;
    }
    
    public function obtenerusuarios()
    {
        try {
            $idUsuario = Auth::user()->id;
            $usuarios  = DB::select("select * from obtenerUSuariosContratos({$idUsuario})");
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $usuarios;
    }
}