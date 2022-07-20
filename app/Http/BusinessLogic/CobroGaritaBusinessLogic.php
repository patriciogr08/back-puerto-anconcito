<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\CobroGaritaRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;

class CobroGaritaBusinessLogic {

    private $_cobroGaritaRepository;

    public function __construct()
    {
        $this->_cobroGaritaRepository = new CobroGaritaRepository();
    }

    public function listaCobros(){
        try {
            $data = $this->_cobroGaritaRepository->index();
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));
        }
        return $data;
    }

    public function crearCobroGarita($request){
        try {
            $data = $request->all();
            $data = $this->_cobroGaritaRepository->create($data);
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
        return $data;
    }


}