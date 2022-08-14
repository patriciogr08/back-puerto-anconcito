<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\ClienteRepository;
use Dotenv\Exception\ValidationException;
use Exception;

class ClienteBusinessLogic {

    private $_clienteRepository;

    public function __construct()
    {
        $this->_clienteRepository = new ClienteRepository();
    }

    public function listarClientes(){
        try {
            $data = $this->_clienteRepository->index();
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
      
        return $data;
    }

    public function buscarCliente($identificacion){
        try {
            $data = $this->_clienteRepository->findCliente($identificacion);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
      
        return $data;
    }

    public function obtenerCliente($cliente){
        try {
            $data = $this->_clienteRepository->show($cliente);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
        return $data;
    }

    public function crearCliente($request){
        try {
            $cliente = $request->all();
            $data = $this->_clienteRepository->create($cliente);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function actualizarCliente($request,$cliente){
        try {
            
            if ( !$cliente->activo ) {
                throw new ValidationException(json_encode(['error'=>["No puede modificar un cliente Eliminado."]]));
            }
            
            $datos = $request->all();
            $data = $this->_clienteRepository->update($datos,$cliente);
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function eliminarCliente($cliente){
        try {
            $data = $this->_clienteRepository->destroy($cliente);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

}