<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

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
     * @return Response\iStrategy
     */
    public static function getStrategy($qop, $ha1, $ha2, $nonce, $nc = NULL, $cnonce = NULL)
    {
        switch (strtoupper($qop))
        {
            case static::ALGORITHM_AUTH:
                // FALL THROUGH
            case static::ALGORITHM_AUTH_INIT:

                return new Response\Auth($ha1, $ha2, $nonce, $nc, $cnonce, $qop);

                break;

            default:

                return new Response\Unspecified($ha1, $ha2, $nonce);

                break;
        }
    }
}