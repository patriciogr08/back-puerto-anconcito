<?php

namespace app\Http\Repository;

use App\Models\User;
use Exception;

class UserRepository {

    public function all(){
        try {
            $usuario = User::where('activo',true)->get();
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $usuario;
    }

    public function show($user)
    {
        $roles = $user->getRoleNames();
        $user->roles = $roles;
                
        return $user;
    }

    public function create($data){
        try {
            $data['password'] = bcrypt($data['password']);
            $usuario = User::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $usuario;
    }


    public function update($data, $user)
    {
        try {
            $user->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $user;
    }


    public function destroy($user)
    {
        try {
            $data = ["activo"=>false];
            $user->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $user;
    }

}