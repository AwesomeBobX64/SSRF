<?php

namespace Http\Header\Request\Authorization\Digest;

use \Http\Exception;

class Strategy
{
    const ALGORITHM_AUTH      = 'AUTH';
    const ALGORITHM_AUTH_INIT = 'AUTH-INIT';
    const ALGORITHM_MD5       = 'MD5';
    const ALGORITHM_MD5_SESS  = 'MD5-SESS';

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest credentials.
     * @param string $password Used for authorization.
     * @throws \UnexpectedValueException Thrown if an unknown, non NULL algorithm value is passed.
     * @return string
     */
    public static function getHa1($credentials, $password)
    {
        $algorithm      = isset_or($credentials['algorithm']);
        $username       = isset_or($credentials['username']);
        $realm          = isset_or($credentials['realm']);
        $algorithmUpper = strtoupper($algorithm);

        if (is_null($algorithm) || static::ALGORITHM_MD5 == $algorithmUpper)
        {
            $ha1 = new Ha1\Md5($username, $realm, $password);
        }
        elseif (static::ALGORITHM_MD5 == $algorithmUpper)
        {
            $nonce  = isset_or($credentials['nonce']);
            $cnonce = isset_or($credentials['cnonce']);
            $ha1    = new Ha1\Md5Sess($username, $realm, $password, $nonce, $cnonce);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown algorithm: ' . $algorithm, Exception::CODE_BAD_REQUEST);
        }

        return $ha1->calculateHa1();
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest authentication credentials.
     * @param string $method The request method.
     * @param string $body The body of the request.
     * @throws \UnexpectedValueException Thrown if an unknown, non NULL qop value is passed.
     * @return string
     */
    public static function getHa2($credentials, $method, $body = NULL)
    {
        $qop      = isset_or($credentials['qop']);
        $uri      = isset_or($credentials['uri']);
        $qopUpper = strtoupper($qop);

        if (is_null($qop) || static::ALGORITHM_AUTH == $qopUpper)
        {
            $ha2 = new Ha2\Auth($method, $uri);
        }
        elseif (static::ALGORITHM_AUTH_INIT == $qopUpper)
        {
            $ha2 = new Ha2\AuthInit($method, $uri, $body);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown qop value:' . $qop, Exception::CODE_BAD_REQUEST);
        }

        return $ha2->calculateHa2();
    }

    /**
     * Calculates response, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest authentication credentials.
     * @param string $password A password for authentication.
     * @param string $method A request method.
     * @param string $body An optional message body.
     * @return string
     */
    public static function getResponse($credentials, $password, $method, $body = NULL)
    {
        $ha1   = static::getHa1($credentials, $password);
        $ha2   = static::getHa2($credentials, $method, $body);
        $qop   = isset_or($credentials['qop']);
        $nonce = isset_or($credentials['nonce']);

        if (is_null($qop))
        {
            $response = new Response\Unspecified($ha1, $ha2, $nonce);
        }

        $qopUpper = strtoupper($qop);

        if (static::ALGORITHM_AUTH == $qopUpper || static::ALGORITHM_AUTH_INIT == $qopUpper)
        {
            $nc       = isset_or($credentials['nc']);
            $cnonce   = isset_or($credentials['cnonce']);
            $response = new Response\Auth($ha1, $ha2, $nonce, $nc, $cnonce, $qop);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown qop value: ' . $qop, Exception::CODE_BAD_REQUEST);
        }

        return $response->calculateResponse();
    }
}