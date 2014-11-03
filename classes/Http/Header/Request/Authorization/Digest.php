<?php

namespace Http\Header\Request\Authorization;

class Digest extends \Http\Header\Request\AbstractAuthorization
{
    const QOP_AUTH      = 'AUTH';
    const QOP_AUTH_INIT = 'AUTH-INIT';

    protected function _getCredentialsFromValue($value)
    {
        $credentials = [];

        preg_match_all('/,?(?P<keys>[^=\s]+)\s*?=\s*?"?(?P<values>[^",]*)"?/', $value, $pieces);

        foreach ($pieces['keys'] as $index => $key)
        {
            $credentials[$key] = $pieces['values'][$index];
        }

        return $credentials;
    }

    /**
     * Accepts a password, method, and optional message body to determine if digest authentication is authorized.
     *
     * @param string $password A password for authentication.
     * @param string $method A request method.
     * @param string $body An optional message body.
     * @return boolean
     */
    public function isAuthorized($password, $method, $body = NULL)
    {
        $credentials = $this->getCredentials();
        $qop         = isset_or($credentials['qop']);
        $nonce       = isset_or($credentials['nonce']);
        $ha1         = Digest\Strategy\Ha1::getHa1($credentials, $password, $nonce);
        $ha2         = Digest\Strategy\Ha2::getHa2($credentials, $qop, $method, $body);
        $response    = Digest\Strategy\Response::getResponse($credentials, $qop, $ha1, $ha2, $nonce);

        return ($response == $credentials['response']);
    }
}