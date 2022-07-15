<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller;
use \Carbon\Carbon;

class AuthController extends Controller
{
    //
    public function login(LoginAuth $request) {
        try {
            $request->validated();
            $credenciales = $request->only('usuario', 'password');

            if ( !Auth::attempt($credenciales) ) {
                $status  = Response::HTTP_UNPROCESSABLE_ENTITY; 
                $message = "* Credenciales Inválidas.";

                return response_error($status, $message);
            }

            $usuario = Auth::user();
            $usuario->equipo;
            $usuario->perfil;
            $tokenResult = $usuario->createToken('authToken');

            $token = [
                'tokenType'    => 'Bearer',
                'accessToken'  => $tokenResult->accessToken,
                'createdAt'    => Carbon::parse($tokenResult->token->created_at)->toDateTimeString(),
                'expiresAt'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ];

            $permisos    = [];
            $objPermisos = $usuario->getAllPermissions();            
            foreach ( $objPermisos as $permiso ) { 
                array_push($permisos, $permiso->name); 
            }
            
            $roles    = $usuario->getRoleNames();

            $data   = [
                'usuario'  => $usuario,
                'token'    => $token,
                'roles'    => $roles,
                'permisos' => $permisos
            ];

        } catch (\Throwable $ex) {

            $status  = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = $ex->getMessage();//"Ocurrió un error al iniciar la sesión de usuario.";

            return response_error($status, $message);

        }         

        $status  = Response::HTTP_OK;
        $message = "Ha ingresado al sistema satisfactoriamente.";
        
        return response_success($data, $status, $message);

    }


    public function logout() { 

        Auth::user()->token()->revoke();

        $data    = null;
        $status  = Response::HTTP_OK;        
        $message = "Sesión finalizada correctamente.";

        return response_success($data, $status, $message);
        
    }
}
