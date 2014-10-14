<?php

require '../includes/bootstrap.php';

$request     = \Http\Message\Request::create();
$header      = $request->getHeader(\Http\Header\Request::FIELD_AUTHORIZATION);
$password    = 'Circle Of Life';
$method      = $request->getMethod();
$credentials = $header->getCredentials();

if ($credentials['username'] == 'Mufasa')
{
    $authorized = $header->isAuthorized($password, $method);

    error_log(var_export($authorized, TRUE));
}