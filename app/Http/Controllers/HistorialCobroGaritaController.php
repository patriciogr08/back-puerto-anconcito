<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\HistorialCobroGaritaBusinessLogic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\Requests\CierreTurnoCobro;

class HistorialCobroGaritaController extends Controller
{
    //
    private $_historialCobroGaritaBusinessLogic;
    public function __construct()
    {
        $this->_historialCobroGaritaBusinessLogic = new HistorialCobroGaritaBusinessLogic();
        //$this->middleware('can:api.historialCobroGarita.aperturarTurnoCobro')->only('aperturarTurnoCobro');
        //$this->middleware('can:api.historialCobroGarita.cerrarTurnoCobro')->only('cerrarTurnoCobro');
        //$this->middleware('can:api.historialCobroGarita.valoresTurno')->only('valoresTurno');
    }

    public function aperturarTurnoCobro(Request $request){
        try {
            $data = $this->_historialCobroGaritaBusinessLogic->aperturarHistorialCobro($request);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al aperturar turno de cobro garitas.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;
        $message = "Turno aperturado correctamente.";
        return response_success($data, $status, $message);
    }

    public function valoresTurno(Request $request){
        try {
            $data = $this->_historialCobroGaritaBusinessLogic->valoresTurno($request);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al obtener los calores de cobro garita.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Valores del turno obtenidos correctamente.";
        return response_success($data, $status, $message);
    }

    public function cerrarTurnoCorbo(CierreTurnoCobro $request){
        try {
            $data = $this->_historialCobroGaritaBusinessLogic->cerrarTurno($request);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al cerrar turno de cobro garitas.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Turno cerrado correctamente.";
        return response_success($data, $status, $message);
    }

}