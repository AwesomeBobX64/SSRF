<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Response;

class Context
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
     * @param string $nonceCount A request counter, specified by the client.
     * @param string $cnonce A client generated random string.
     * @return iStrategy A class which implements the iStrategy interface.
     */
    public static function getStrategy($qop, $ha1, $ha2, $nonce, $nonceCount = NULL, $cnonce = NULL)
    {
        switch (strtoupper($qop))
        {
            case static::ALGORITHM_AUTH:
                // FALL THROUGH
            case static::ALGORITHM_AUTH_INIT:

                return new Auth($ha1, $ha2, $nonce, $nonceCount, $cnonce, $qop);

                break;

            default:

                return new Unspecified($ha1, $ha2, $nonce);

                break;
        }
    }
}