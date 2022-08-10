<?php

namespace App\Http\Controllers;

use App\Http\BusinessLogic\UserBusinessLogic;
use Illuminate\Http\Response;
use Dotenv\Exception\ValidationException;

use App\Http\Controller;
use App\Http\Requests\AsignarRolUser;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_userBusinessLogic;

    public function __construct()
    {
        $this->_userBusinessLogic = new UserBusinessLogic();
        //$this->middleware('can:api.users.index')->only('index');
        //$this->middleware('can:api.users.store')->only('store');
        //$this->middleware('can:api.users.update')->only('update');
        //$this->middleware('can:api.users.destroy')->only('destroy');
        //$this->middleware('can:api.users.asignarRol')->only('asignarRol');
        //$this->middleware('can:api.users.removerRol')->only('removerRol');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Response::HTTP_OK;
        $message = "Usuarios mostrados correctamente.";
        $data = $this->_userBusinessLogic->obtenerUsuarios();
        return response_success($data, $status, $message);
    }

    public function store(StoreUser $request){
        try {
            $data = $this->_userBusinessLogic->crearUsuario($request);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al realizar el cobro de garita.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;

        $message = "Usuario creado correctamente.";
        return response_success($data, $status, $message);
    }

    public function update(Request $request,User $user)
    {
        try {
            $data = $this->_userBusinessLogic->actualizarUsuario($request, $user);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar actualizar el usuario .";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Usuario actualizado correctamemte.";
        return response_success($data, $status, $message);
    }

    public function destroy(User $user){
        try {
            $data = $this->_userBusinessLogic->desactivarUsuario($user);
        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al realizar el cobro de garita.";
            return response_error($status, $message);
        }
        $status = Response::HTTP_CREATED;

        $message = "Usuario creado correctamente.";
        return response_success($data, $status, $message);
    }

    public function asignarRol(User $user,AsignarRolUser $request)
    {
        try {
            $data = $this->_userBusinessLogic->asignarRol($user, $request);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar asignar rol al usuario .";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Usuario actualizado correctamemte.";
        return response_success($data, $status, $message);
    }

    public function removerRol(User $user,AsignarRolUser $request)
    {
        try {
            $data = $this->_userBusinessLogic->quitarRol($user, $request);

        }catch (ValidationException $ex) {
            $status  = Response::HTTP_UNPROCESSABLE_ENTITY;
            $message = json_decode($ex->getMessage());
            return response_error($status, $message);

        } catch (\Throwable $ex) {
            $status     = Response::HTTP_BAD_REQUEST;
            $message    = "Error al intentar remover el rola al usuario .";
            return response_error($status, $message);
        }
        $status = Response::HTTP_OK;
        $message = "Usuario actualizado correctamemte.";
        return response_success($data, $status, $message);
    }
}