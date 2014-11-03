<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

use \Http\Exception;

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
     * @throws \UnexpectedValueException Thrown if an unknown, non NULL qop value is passed.
     * @return Ha2\iStrategy
     */
    protected static function _getStrategy($qop, $method, $uri, $body = NULL)
    {
        $qopUpper = strtoupper($qop);

        if (is_null($qop) || static::ALGORITHM_AUTH == $qopUpper)
        {
            return new Ha2\Auth($method, $uri);
        }
        elseif (static::ALGORITHM_AUTH_INIT == $qopUpper)
        {
            return new Ha2\AuthInit($method, $uri, $body);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown qop value:' . $qop, Exception::CODE_BAD_REQUEST);
        }
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest authentication credentials.
     * @param string $qop A quality of protection value.
     * @param string $method An HTTP request method.
     * @param string $body An optional message body for calculating HA2.
     * @return string
     */
    public static function getHa2($credentials, $qop, $method, $body = NULL)
    {
        $uri = isset_or($credentials['uri']);
        $ha2 = static::_getStrategy($qop, $method, $uri, $body);

        return $ha2->calculateHa2();
    }
}