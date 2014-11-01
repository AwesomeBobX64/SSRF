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

    protected function _getHa1($credentials, $password)
    {
        $algorithm = isset_or($credentials['algorithm']);
        $username  = isset_or($credentials['username']);
        $realm     = isset_or($credentials['realm']);
        $nonce     = isset_or($credentials['nonce']);
        $cnonce    = isset_or($credentials['cnonce']);
        $ha1       = Digest\Strategy\Ha1::getStrategy($algorithm, $username, $realm, $password, $nonce, $cnonce);

        return $ha1->calculateHa1();
    }

    protected function _getHa2($credentials, $qop, $method, $body = NULL)
    {
        $uri = isset_or($credentials['uri']);
        $ha2 = Digest\Strategy\Ha2::getStrategy($qop, $method, $uri, $body);

        return $ha2->calculateHa2();
    }

    protected function _getResponse($credentials, $qop, $ha1, $ha2, $nonce)
    {
        $nc       = isset_or($credentials['nc']);
        $cnonce   = isset_or($credentials['cnonce']);
        $response = Digest\Strategy\Response::getStrategy($qop, $ha1, $ha2, $nonce, $nc, $cnonce);

        return $response->calculateResponse();
    }

    public function isAuthorized($password, $method, $body = NULL)
    {
        $credentials = $this->getCredentials();
        $qop         = isset_or($credentials['qop']);
        $ha1         = $this->_getHa1($credentials, $password);
        $ha2         = $this->_getHa2($credentials, $qop, $method, $body);
        $nonce       = isset_or($credentials['nonce']);
        $response    = $this->_getResponse($credentials, $qop, $ha1, $ha2, $nonce);

        return ($response == $credentials['response']);
    }
}