<?php

namespace app\Http\BusinessLogic;

use App\Http\Repository\CobroGaritaRepository;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $data = null;
            DB::transaction(function() use ($request, &$data) {
                $servicio = 1;
                $ano      = Carbon::now()->format('Y');
                $data     = $request->all();
                $contador = DB::select("select * from genera_contadores({$ano},{$servicio})")[0];
                $numero   = sprintf("%07d", $contador->genera_contadores);
                $numTicket= "CG-{$ano}-{$numero}";
                $data['ticket'] = $numTicket;
                $data = $this->_cobroGaritaRepository->create($data);
            });
        } catch (\Throwable $ex) {
            throw new Exception('Error'.$ex->getMessage().' Clase: '.class_basename($this));

        }
        return $data;
    }


}