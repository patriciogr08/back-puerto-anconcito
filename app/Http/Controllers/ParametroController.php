<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\BusinessLogic\ParametroBusinessLogic;

class ParametroController extends Controller
{
    private $_parametroBusinessLogic;
    public function __construct()
    {
        $this->_parametroBusinessLogic = new ParametroBusinessLogic();
        //$this->middleware('can:api.parametro.obtenerListaParametros')->only('obtenerListaParametros');
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
}