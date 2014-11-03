<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

use \Http\Exception;

class Response
{
    const ALGORITHM_AUTH      = 'AUTH';
    const ALGORITHM_AUTH_INIT = 'AUTH-INIT';

    /**
     * Returns a strategy for calculating the response in Digest Authentication.
     *
     * @param string $qop The "quality of protection" parameter.
     * @param string $ha1 HA1 in Digest Authentication
     * @param string $ha2 HA2 in Digest Authentication
     * @param string $nonce A server generated random string.
     * @param string $nc A request counter, specified by the client.
     * @param string $cnonce A client generated random string.
     * @throws \UnexpectedValueException Thrown if an unknown, non NULL qop value is passed.
     * @return Response\iStrategy
     */
    public static function _getStrategy($qop, $ha1, $ha2, $nonce, $nc = NULL, $cnonce = NULL)
    {
        if (is_null($qop))
        {
            return new Response\Unspecified($ha1, $ha2, $nonce);
        }

        $qopUpper = strtoupper($qop);

        if (static::ALGORITHM_AUTH == $qopUpper || static::ALGORITHM_AUTH_INIT == $qopUpper)
        {
            return new Response\Auth($ha1, $ha2, $nonce, $nc, $cnonce, $qop);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown qop value:' . $qop, Exception::CODE_BAD_REQUEST);
        }
    }

    /**
     * Calculates response, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest authentication credentials.
     * @param string $qop A quality of protection value.
     * @param string $ha1 HA1 in digest authentication.
     * @param string $ha2 HA2 in digest authentication.
     * @param string $nonce A server generated nonce vlaue.
     * @return string
     */
    public static function getResponse($credentials, $qop, $ha1, $ha2, $nonce)
    {
        $nc       = isset_or($credentials['nc']);
        $cnonce   = isset_or($credentials['cnonce']);
        $response = static::_getStrategy($qop, $ha1, $ha2, $nonce, $nc, $cnonce);

        return $response->calculateResponse();
    }
}