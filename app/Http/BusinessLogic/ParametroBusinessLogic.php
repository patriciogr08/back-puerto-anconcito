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
            
            $tipoIdentificacion      = Parametro::select('id','codigo','nombre','valor')->where('idPadre', $tipoIdentificacion->id)->get();

        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());    
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
      
        return $tipoIdentificacion;
    }

    
}
