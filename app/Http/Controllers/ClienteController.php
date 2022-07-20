<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Models\Cliente;
use App\Http\BusinessLogic\ClienteBusinessLogic;
use App\Http\Requests\StoreCliente;

class ClienteController extends Controller
{
    //
    private $_clienteBusinessLogic;
    public function __construct()
    {
        $this->_clienteBusinessLogic = new ClienteBusinessLogic();
        //$this->middleware('can:api.clientes.index')->only('index');
        // $this->middleware('can:api.clientes.show')->only('show');
        // $this->middleware('can:api.clientes.store')->only('store');
        // $this->middleware('can:api.clientes.update')->only('update');
        // $this->middleware('can:api.clientes.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Response::HTTP_OK;
        $message = "Clientes mostrados correctamente.";
        $data = $this->_clienteBusinessLogic->listarClientes();
        return response_success($data, $status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {               
        $status = Response::HTTP_OK;
        $message = "Cliente mostrado correctamente.";
        $data = $this->_clienteBusinessLogic->obtenerCliente($cliente);
        return response_success($data, $status, $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliente $request)
    {
        try {
            $data = $this->_clienteBusinessLogic->crearCliente($request);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error crear el cliente.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;
        $message = "Cliente creado correctamente.";
        return response_success($data, $status, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
        try {
            $data = $this->_clienteBusinessLogic->actualizarCliente($request, $cliente);
        
        } catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);  
        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al intentar actualizar el cliente.";
            return response_error($status, $message);
        }

        $status  = Response::HTTP_OK;
        $message = "Cliente actualizado correctamente.";
        $data    = $data;
        return response_success($data, $status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
        try {
            $data = $this->_clienteBusinessLogic->eliminarCliente($cliente);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error elimnar el cliente.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;
        $message = "Cliente eliminado correctamente.";
        return response_success($data, $status, $message);
    }

}
