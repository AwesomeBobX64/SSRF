<?php

require '../includes/bootstrap.php';

$request = \Http\Message\Request::create();

foreach ($request->getHeaders() as $index => $header)
{
    if ($index == \Http\Header\Request::FIELD_AUTHORIZATION)
    {
        $password    = 'Circle Of Life';
        $method      = $request->getMethod();
        $credentials = $header->getCredentials();

        if ($credentials['username'] == 'Mufasa')
        {
            $authorized = $header->isAuthorized($password, $method);
        }
    }
}