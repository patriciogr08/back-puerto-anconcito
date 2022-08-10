<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\ParametroRepository;
use Dotenv\Exception\ValidationException;
use App\Models\Parametro;
use Exception;

class ParametroBusinessLogic {

    private $_parametroRepository;

    public function __construct()
    {
        $this->_parametroRepository = new ParametroRepository();
    }

    public function obtenerListaParametros($codigo){
        try {
            $tipoIdentificacion = $this->_parametroRepository->obtenerParamtrosCodigo($codigo);

            if ( !$tipoIdentificacion ) {
                throw new ValidationException(json_encode(['error'=>["No existe la lista de parametro a buscar."]]));
            }
            
            $tipoIdentificacion      = Parametro::select('id','codigo','nombre','descripcion','valor','activo')
                                                    ->where('idPadre', $tipoIdentificacion->id)
                                                    ->where('activo',true)->get();

        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());    
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
      
        return $tipoIdentificacion;
    }

    public function obtenerPadres() {
        try {
            //code...
            $parametroPadres = $this->_parametroRepository->obtenerParametrosPadres();

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametroPadres;
    }

    public function crearPadre($request){
        try {
            //code...
            $data      = $request->all();
            $data['idTipo']  = Parametro::where('codigo','PAR-LISTA')->first()->id;
            $data['idPadre'] = null;
            $parametro = $this->_parametroRepository->create($data);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    public function crearHijo($request){
        try {
            //code...
            $data      = $request->all();
            $data['idTipo']  = Parametro::where('codigo','PAR-ELEMENTO-LISTA')->first()->id;
            $parametro = $this->_parametroRepository->create($data);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    public function actualizarParametro($request, $parametro) {
        try {
            //code...
            $data = $request->all();
            $parametro = $this->_parametroRepository->update($data, $parametro);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    public function eliminarParametro($parametro) {
        try {
            //code...
            $parametro = $this->_parametroRepository->destroy($parametro);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    
}
