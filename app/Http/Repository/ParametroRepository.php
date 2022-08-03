<?php

namespace app\Http\Repository;

use App\Models\Parametro;
use Illuminate\Support\Facades\Auth;
use Exception;

class ParametroRepository {

    public function obtenerParamtrosCodigo($codigoParamatero)
    {
        $data     = Parametro::where('codigo', $codigoParamatero)->first();
        return $data;
    }

    public function show($cliente) 
    {
        return $cliente;
    }

    public function create($data){
        try {
            $data['idUsuarioCreacion'] = Auth::user()->id;
            $parametro = Parametro::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $parametro;
    }


    public function update($data, $parametro)
    {
        try {
            $parametro->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $parametro;
    }


    public function destroy($parametro)
    {
        try {
            $data = ["activo"=>0];
            $parametro->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $parametro;
    }


    public function obtenerParametrosPadres()
    {
        $data     = Parametro::where('idPadre', null)->whereNotIn('codigo',['PARAM','PAR-LISTA','PAR-ELEMENTO-LISTA'])->get();
        return $data;
    }

}