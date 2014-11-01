<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

class Ha2
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
     * @return Ha2\iStrategy
     */
    public static function getStrategy($qop, $method, $uri, $body = NULL)
    {
        switch (strtoupper($qop))
        {
            case static::ALGORITHM_AUTH_INIT:

                return new Ha2\AuthInit($method, $uri, $body);

                break;

            case static::ALGORITHM_AUTH:
                // FALL THROUGH
            default:

                return new Ha2\Auth($method, $uri);

                break;
        }
    }
}