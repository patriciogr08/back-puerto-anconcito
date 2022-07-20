<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\CobroGaritaBusinessLogic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\Requests\StoreCobroGarita;

class CobroGaritaController extends Controller
{
    private $_cobroGaritaBusinessLogic;

    public function __construct()
    {
        $this->_cobroGaritaBusinessLogic = new CobroGaritaBusinessLogic();
        //$this->middleware('can:api.cobroGarita.index')->only('index');
        //$this->middleware('can:api.cobroGarita.store')->only('store');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Response::HTTP_OK;
        $message = "Cobros de garita mostrados correctamente.";
        $data = $this->_cobroGaritaBusinessLogic->listaCobros();
        return response_success($data, $status, $message);
    }

    public function store(StoreCobroGarita $request){
        try {
            $data = $this->_cobroGaritaBusinessLogic->crearCobroGarita($request);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = $ex->getMessage();//"Error al realizar el cobro de garita.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;
        $message = "Cobro creado correctamente.";
        return response_success($data, $status, $message);
    }
}