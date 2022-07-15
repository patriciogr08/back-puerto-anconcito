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