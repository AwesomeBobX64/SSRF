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
        $response    = Digest\Strategy::getResponse($credentials, $password, $method, $body);

        return ($response == $credentials['response']);
    }
}