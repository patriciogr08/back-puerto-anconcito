<?php

namespace app\Http\Repository;

use App\Models\HistorialCobroGarita;
use Illuminate\Support\Facades\Auth;
use Exception;

class HistorialCobrosGaritaRepository {

    public function index()
    {
        $data     = HistorialCobroGarita::paginate(100);
        return $data;
    }

    public function create($data){
        try {
            $historial = HistorialCobroGarita::create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }

        return $historial;
    }

    public function update($data,$historial){
        try {
            $historial->update($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $historial;
    }

}