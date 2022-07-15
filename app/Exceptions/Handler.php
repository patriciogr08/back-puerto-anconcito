<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Throwable $exception, $request) {     
            /**
             * Manejador de errores
             */
            if ( $request->wantsJson() ) {

                if ( $exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException ) {
                    $status = Response::HTTP_NOT_FOUND;
                    $message = "Registro no encontrado.";
                    return response_error($status, $message);
                }
                
                if ( $exception instanceof BadRequestHttpException ) {
                    $status = Response::HTTP_BAD_REQUEST;
                    $message = "Ocurrió un error en la solicitud.";
                    return response_error($status, $message);
                }
    
                if ( $exception instanceof ValidationException ) {
                    $status = Response::HTTP_UNPROCESSABLE_ENTITY;
                    $message = $exception->errors();
                    return response_error($status, $message);
                }

                if ( $exception instanceof AuthenticationException || $exception instanceof AuthorizationException ) {
                    $status = Response::HTTP_UNAUTHORIZED;
                    $message = "No está autorizado para acceder a este recurso.";
                    return response_error($status, $message);
                }

                if ( $exception instanceof HttpException && $exception->getStatusCode() == 403 ) {
                    $status = Response::HTTP_FORBIDDEN;
                    $message = "No tiene permiso para acceder a este recurso.";
                    return response_error($status, $message);
                }
            }
        });
    }
}
