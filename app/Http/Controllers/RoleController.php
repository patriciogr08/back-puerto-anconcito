<?php

namespace App\Http\Controllers;


use App\Http\BusinessLogic\RoleBusinessLogic;
use Illuminate\Http\Response;
use App\Http\Controller;
use App\Http\Requests\StoreRole;
use Spatie\Permission\Models\Role;
use Dotenv\Exception\ValidationException;

class RoleController extends Controller
{
    private $_roleBusinessLogic;

    public function __construct()
    {
        $this->_roleBusinessLogic = new RoleBusinessLogic();
        // $this->middleware('can:api.v1.roles.index')->only('index');
        // $this->middleware('can:api.v1.roles.show')->only('show');
        // $this->middleware('can:api.v1.roles.store')->only('store');
        // $this->middleware('can:api.v1.roles.update')->only('update');
        // $this->middleware('can:api.v1.roles.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $status  = Response::HTTP_OK;
            $message = "Listado de roles mostrados correctamente.";
            $roles   = $this->_roleBusinessLogic->obtenerRoles();

        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al intentar obtener el listado de roles.";

            return response_error($status, $message);
        }
        
        return response_success($roles, $status, $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        try {
            $request->validated();
            $data = $this->_roleBusinessLogic->crearRole($request);

        } catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());

            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = $ex->getMessage();//"Ocurrió un error al intentar crear el rol.";

            return response_error($status, $message);
        }

        $status  = Response::HTTP_CREATED;
        $message = "Rol creado correctamente.";

        return response_success($data, $status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $status  = Response::HTTP_OK;
        $message = "Rol mostrado correctamente.";
        $data    = $role;//$this->_roleBusinessLogic->show($role);

        return response_success($data, $status, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRole $request, Role $role)
    {
        try {
            $request->validated();

            $data = $this->_roleBusinessLogic->actualizarRole($request, $role);

        } catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());

            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al intentar actualizar el rol.";

            return response_error($status, $message);
        }

        $status  = Response::HTTP_OK;
        $message = "Rol actualizado correctamente.";

        return response_success($data, $status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role = $this->_roleBusinessLogic->borrarRol($role);

        } catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());

            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = $ex->getMessage();//"Ocurrió un error al intentar eliminar el rol.";

            return response_error($status, $message);
        }

        $status  = Response::HTTP_OK;
        $message = "Rol eliminado correctamente.";

        return response_success($role, $status, $message);
    }
}