<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\UserRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Spatie\Permission\Models\Role;

class UserBusinessLogic {

    private $_userRepository;

    public function __construct()
    {
        $this->_userRepository = new UserRepository();
    }

    public function obtenerUsuarios(){
        try {
            $data = $this->_userRepository->all();
            foreach ($data as $user) {
                $roles = $user->getRoleNames();
                $user->roles = $roles;
            }
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function crearUsuario($request){
        try {
            $user = $request->all();
            $data = $this->_userRepository->create($user);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function actualizarUsuario($request,$user){
        try {
            
            if ( !$user->activo ) {
                throw new ValidationException(json_encode(['error'=>["No puede modificar un usuario Eliminado."]]));
            }
            
            $data = $request->all();
            if ( key_exists('password', $data) )  $data['password'] = bcrypt($data['password']);;

            $data = $this->_userRepository->update($data,$user);
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }


    public function desactivarUsuario($user){
        try {
            $data = $this->_userRepository->destroy($user);

        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }


    public function asignarRol($user,$request) {
        try {
            $rol = Role::where('name',$request->name)->first();

            if( !$rol ) 
                throw new ValidationException(json_encode(['error'=>["No existe el rol a asignar."]]));

            $data = $user->assignRole($rol->name);
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function quitarRol($user,$request) {
        try {
            $rol = Role::where('name',$request->name)->first();

            if( !$rol ) 
                throw new ValidationException(json_encode(['error'=>["No existe el rol que desea quitar."]]));

            $data = $user->removeRole($rol->name);
        } catch (ValidationException $ex) {
            throw new ValidationException($ex->getMessage());  
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }
   
}