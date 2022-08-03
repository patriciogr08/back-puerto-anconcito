<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\RoleRepository;
use Dotenv\Exception\ValidationException;
use App\Models\User;
use Exception;

class RoleBusinessLogic {

    private $_roleRepository;

    public function __construct()
    {
        $this->_roleRepository = new RoleRepository();
    }

    public function obtenerRoles(){
        try {
            $roles = $this->_roleRepository->all();

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
      
        return $roles;
    }

    public function crearRole($request) {
        try {
            //code...
            $data = $request->all();
            $data['guard_name'] = "web";
            $parametroPadres = $this->_roleRepository->create($data);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametroPadres;
    }

    public function actualizarRole($request,$role){
        try {
            //code...
            $data      = $request->all();
            $parametro = $this->_roleRepository->update($data,$role);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    public function borrarRol($role){
        try {
             /**
             * Validar que el rol no esté asignado a ningún usuario.
             */
            $users = User::role($role->name)->get();

            if ( count($users) > 0 ) {
                throw new ValidationException(json_encode(['error' => ["No puede eliminar este Rol porque tiene usuarios asignados."]]));
            }

            $parametro = $this->_roleRepository->destroy($role);
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());    
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }

        return $parametro;
    }

    
}
