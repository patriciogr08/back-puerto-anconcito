<?php

function response_error($status, $message)
{
    $success = null;

    $error = [
        "code" => $status,
        "content" => $message,
    ];
    $data = null;
    $response = [
        "success" => $success,
        "error" => $error,
        "data" => $data,
    ];

    return response()->json($response, $status);
}

function response_success($data, $status, $message)
{
    $success = [
        "code" => $status,
        "content" => $message,
    ];

    $error = null;
    $response = [
        "success" => $success,
        "error" => $error,
        "data" => $data,
    ];

    return response()->json($response, $status);
}

function enviarCorreo( $request ) {

    try {
        require_once('../vendor/autoload.php');    
        
        $credentials   = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_KEY', ''));
        $apiInstance   = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $credentials);
        
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject'    => $request->asunto,
            'sender'     => $request->remitente,
            'replyTo'    => $request->responderA,
            'to'         => $request->para,
            'cc'         => $request->cc,
            'params'     => $request->params,
            'templateId' => $request->templateId,
        ]);
    
        $data = $apiInstance->sendTransacEmail($sendSmtpEmail);
        
    } catch (\Throwable $ex) {
        throw new Exception('Error' . $ex->getMessage() . ' Clase: Helper');

    }

    return $data;
}