<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\ControlEmpleadosBusinessLogic;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\Requests\StoreCrearContrato;
use App\Http\Requests\StoreUser;
use App\Models\ControlEmpleado;
use Illuminate\Http\Request;

class ControlEmpleadosController extends Controller
{
    private $_controlEmpleadosBusinessLogic;

    public function __construct()
    {
        $this->_controlEmpleadosBusinessLogic = new ControlEmpleadosBusinessLogic();
        //$this->middleware('can:api.controlEmpleados.index')->only('index');
        //$this->middleware('can:api.controlEmpleados.store')->only('store');
        //$this->middleware('can:api.controlEmpleados.destroy')->only('destroy');
        //$this->middleware('can:api.controlEmpleados.obtenerUsuarios')->only('obtenerUsuarios');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Response::HTTP_OK;
        $message = "Contratos mostrados correctamente.";
        $data = $this->_controlEmpleadosBusinessLogic->obtenerContratos();
        return response_success($data, $status, $message);
    }

    public function store(StoreCrearContrato $request){
        try {
            $data = $this->_controlEmpleadosBusinessLogic->crearContratos($request);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al crear el contrato del cliente.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;
        $message = "Contrato creado correctamente.";
        return response_success($data, $status, $message);
    }

    public function obtenerUsuarios()
    {
        try {
            $data = $this->_controlEmpleadosBusinessLogic->obtenerUsuarios();

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar obtener los usuario .";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Usuarios obtenidos correctamente.";
        return response_success($data, $status, $message);
    }

    public function destroy($id){
        try {
            $data = $this->_controlEmpleadosBusinessLogic->cerrarContrato($id);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al desactivar contrato.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Contrato descativado correctamente.";
        return response_success($data, $status, $message);
    }
}