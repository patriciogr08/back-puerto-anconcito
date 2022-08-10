<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\BusinessLogic\ParametroBusinessLogic;
use App\Http\Requests\StoreParametroHijo;
use App\Http\Requests\StoreParametroPadre;
use App\Models\Parametro;

class ParametroController extends Controller
{
    private $_parametroBusinessLogic;
    public function __construct()
    {
        $this->_parametroBusinessLogic = new ParametroBusinessLogic();
        //$this->middleware('can:api.parametros.update')->only('update');
        //$this->middleware('can:api.parametros.destroy')->only('destroy');
        //$this->middleware('can:api.parametros.obtenerListaParametros')->only('obtenerListaParametros');
        //$this->middleware('can:api.parametros.obtenerPadres')->only('obtenerPadres');
        //$this->middleware('can:api.parametros.storeHijo')->only('storeHijo');
        //$this->middleware('can:api.parametros.storePadre')->only('storePadre');
    }

    public function obtenerLista($codigo)
    {
        try {
            $data = $this->_parametroBusinessLogic->obtenerListaParametros($codigo);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar obtener los parametros.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Lista de parametros obtenidos correctamente.";
        return response_success($data, $status, $message);
    }

    public function obtenerPadres()
    {
        try {
            $data = $this->_parametroBusinessLogic->obtenerPadres();

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar obtener los parametros padres.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Lista de parametros padres obtenidos correctamente.";
        return response_success($data, $status, $message);
    }

    public function storePadre(StoreParametroPadre $request)
    {
        try {
            $data = $this->_parametroBusinessLogic->crearPadre($request);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar registrar el parametro padres.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Parametro padre creado correctamente.";
        return response_success($data, $status, $message);
    }

    public function storeHijo(StoreParametroHijo $request)
    {
        try {
            $data = $this->_parametroBusinessLogic->crearHijo($request);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar registrar los parametros hijos.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Parametro creado correctamente.";
        return response_success($data, $status, $message);
    }

    public function update(Request $request, Parametro $parametro)
    {
        try {
            $data = $this->_parametroBusinessLogic->actualizarParametro($request, $parametro);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar actualizar el parametro.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Parametro actualizado correctamente";
        return response_success($data, $status, $message);
    }

    public function destroy(Parametro $parametro)
    {
        try {
            $data = $this->_parametroBusinessLogic->eliminarParametro($parametro);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar elimnar el parametro.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Parametro desactivado correctamente.";
        return response_success($data, $status, $message);
    }
}