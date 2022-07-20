<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('can:api.v1.correo.sendinblue.enviarCorreo')->only('enviarCorreo');
    }
    
    public function enviarCorreo( Request $request ) {
        try {
           $data = enviarCorreo($request);

        } catch (\Throwable $ex) {
            $status  = Response::HTTP_BAD_REQUEST;
            $message = "Ocurrió un error al enviar el correo de notificación.";
            
            return response_error($status, $message);
        }

        $status  = Response::HTTP_OK;
        $message = "Correo enviado correctamente.";

        return response_success($data, $status, $message);
    }
}