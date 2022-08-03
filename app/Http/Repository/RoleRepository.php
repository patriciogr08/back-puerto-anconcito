<?php

namespace app\Http\Repository;

use Spatie\Permission\Models\Role;
use Exception;

class RoleRepository {

    public function all()
    {
        $data     = Role::all();
        return $data;
    }

    public function show($cliente) 
    {
        return $cliente;
    }

    public function create($data){
        try {
            $role = Role::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $role;
    }


    public function update($data, $role)
    {
        try {
            $role->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $role;
    }


    public function destroy($role)
    {
        try {
            $role->delete();
        } catch (\Throwable $ex) {
            throw new Exception('Error' . $ex->getMessage() . ' Clase: ' . class_basename($this));
        }
    }

}