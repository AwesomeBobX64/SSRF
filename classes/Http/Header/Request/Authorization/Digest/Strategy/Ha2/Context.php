<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha2;

class Context
{
    const ALGORITHM_AUTH      = 'AUTH';
    const ALGORITHM_AUTH_INIT = 'AUTH-INIT';

    /**
     * Returns a strategy for calculating HA2 in Digest authentication.
     *
     * @param string $qop The "quality of protection" parameter.
     * @param string $method The request method.
     * @param string $uri The path or single URI the authorization is good for.
     * @param string $body The body of the request.
     * @return iStrategy A class which implements the iStrategy interface.
     */
    public static function getStrategy($qop, $method, $uri, $body = NULL)
    {
        switch (strtoupper($qop))
        {
            case static::ALGORITHM_AUTH_INIT:

                return new AuthInit($method, $uri, $body);

                break;

            case static::ALGORITHM_AUTH:
                // FALL THROUGH
            default:

                return new Auth($method, $uri);

                break;
        }
    }
}