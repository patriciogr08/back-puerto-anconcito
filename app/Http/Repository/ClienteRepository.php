<?php

namespace app\Http\Repository;

use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use Exception;

class ClienteRepository {

    public function index()
    {
        $data     = Cliente::paginate(100);
        return $data;
    }

    public function show($cliente) 
    {
        return $cliente;
    }

    public function create($data){
        try {
            $data['idUsuarioCreacion'] = Auth::user()->id;
            $data['fechaRegistro'] = getdate();
            $cliente = Cliente::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $cliente;
    }


    public function update($data, $cliente)
    {
        try {
            $cliente->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $cliente;
    }


    public function destroy($cliente)
    {
        try {
            $data = ["activo"=>0];
            $cliente->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $cliente;
    }
    

}
