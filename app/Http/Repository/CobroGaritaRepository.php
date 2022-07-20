<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use App\Models\CobroGarita;
use Exception;

class CobroGaritaRepository {

    public function index()
    {
        $data     = CobroGarita::paginate(100);
        return $data;
    }

    public function indexUsuario()
    {
        $data     = CobroGarita::where('idUsuarioCreacion', Auth::user()->id)->get();
        return $data;
    }

    public function show($cobro) 
    {
        return $cobro;
    }

    public function create($data){
        try {
            $data['fecha']             = date('Y-m-d',time());
            $data['hora']              = date('h:i:s a',time());
            $data['idUsuarioCreacion'] = Auth::user()->id;
            $cobro = CobroGarita::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $cobro;
    }


    public function update($data, $cobro)
    {
        try {
            $cobro->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $cobro;
    }


    public function destroy($cobro)
    {
        try {
            $data = ["activo"=>0];
            $cobro->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $cobro;
    }
}
