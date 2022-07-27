<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\ControlEmpleadoRepository;
use App\Models\ControlEmpleado;
use Dotenv\Exception\ValidationException;
use Exception;

class ControlEmpleadosBusinessLogic {

    private $_controlEmpleadosBusinessLogic;

    public function __construct()
    {
        $this->_controlEmpleadosBusinessLogic = new ControlEmpleadoRepository();
    }

    public function obtenerContratos(){
        try {
            $data = $this->_controlEmpleadosBusinessLogic->all();
            foreach($data as $contrato){
                $contrato->empleado;
            }
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function obtenerUsuarios(){
        try {
            $data = $this->_controlEmpleadosBusinessLogic->obtenerusuarios();

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function crearContratos($request){
        try {
            $data = $request->all();

            $existeContrato = ControlEmpleado::where('idEmpleado',$data['idEmpleado'])->where('activo',true)->first();
            
            if ( $existeContrato ) {
                throw new ValidationException(json_encode(['error'=>["El usuario cuenta con un contrato Activo."]]));
            }

            if($data['mesesContrato']==0){
                throw new ValidationException(json_encode(['error'=>["No se puede crear un contrato con 0 meses."]]));
            }

            if ( key_exists('cv', $data) ) $data['cv'] = json_encode($data['cv']);
            if ( key_exists('referencias', $data) ) $data['referencias']= json_encode($data['referencias']);
    
            $fechaFin =  \Carbon\Carbon::parse($data['fechaInicio'])->addMonths($data['mesesContrato'])->format("Y-m-d H:i:s");
            $data['fechaFin'] = $fechaFin;
            
            $data = $this->_controlEmpleadosBusinessLogic->create($data);
            $data->empleado;
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }


    public function cerrarContrato($id){
        try {
            $contrato = ControlEmpleado::find($id);
            if ( !$contrato->activo ) {
                throw new ValidationException(json_encode(['error'=>["No puede finalizar un contrato cerrado."]]));
            }
            $data = $this->_controlEmpleadosBusinessLogic->destroy($contrato);
            $data->empleado;
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }
   
}