<?php

require '../includes/bootstrap.php';

$request = \Http\Message\Request::create();
$header  = $request->getHeader(\Http\Header\Request::FIELD_AUTHORIZATION);

if ($header)
{
    $password = 'Circle Of Life';

    switch (strtoupper($header->getScheme()))
    {
        case \Http\Header\Request\Authorization\Factory::SCHEME_BASIC:

            if ($header->isAuthorized($password))
            {
                die('Success!');
            }
            else
            {
                notAuthorized();
            }

            break;

        case \Http\Header\Request\Authorization\Factory::SCHEME_DIGEST:

            $method = $request->getMethod();

            if ($header->isAuthorized($password, $method))
            {
                die('Success!');
            }
            else
            {
                notAuthorized();
            }

            break;
    }

    notAuthorized();
}

function notAuthorized()
{
    $wwwAuthHeader = \Http\Header\Response\WWWAuthenticate\Basic::create('Awesome Bob\'s World!');

    header($wwwAuthHeader);
}