<?php

namespace Http\Header\Request\Authorization;

class Digest extends \Http\Header\Request\AbstractAuthorization
{
    const QOP_AUTH      = 'AUTH';
    const QOP_AUTH_INIT = 'AUTH-INIT';

    protected function _getCredentialsFromValue($value)
    {
        $credentials = [];
        $pieces      = $this->_splitValueIntoPieces($value);

        foreach ($pieces['key'] as $index => $key)
        {
            $credentials[$key] = $pieces['value'][$index];
        }

        return $credentials;
    }

    protected function _splitValueIntoPieces($value)
    {
        preg_match_all('/,?(?P<key>[^=\s]+)\s*?=[\s*]?"?(?P<value>[^\s,"]+)"?/', $value, $pieces);

        return $pieces;
    }

    public function isAuthorized($password, $method, $body = NULL)
    {
        $credentials = $this->getCredentials();
        $ha1         = $this->_hashArray([$credentials['username'], $credentials['realm'], $password]);
        $qop         = isset($credentials['qop']) ? $credentials['qop'] : '';

        switch (strtoupper($qop))
        {
            case static::QOP_AUTH:

                $ha2      = $this->_hashArray([$method, $credentials['uri']]);
                $response = $this->_computeAuthResponse($ha1, $ha2, $qop, $credentials);

                break;

            case static::QOP_AUTH_INIT:

                $ha2      = $this->_hashArray([$method, $credentials['uri'], md5($body)]);
                $response = $this->_computeAuthResponse($ha1, $ha2, $qop, $credentials);

                break;

            case '':
                // FALL THROUGH
            default:

                $ha2      = $this->_hashArray([$method, $credentials['uri']]);
                $response = $this->_hashArray([$ha1, $credentials['nonce'], $ha2]);

                break;

        }

        return ($response == $credentials['response']);
    }

    protected function _hashArray(array $array)
    {
        return md5(implode(':', $array));
    }

    protected function _computeAuthResponse($ha1, $ha2, $qop, array $credentials)
    {
        return $this->_hashArray([$ha1, $credentials['nonce'], $credentials['nc'], $credentials['cnonce'], $qop, $ha2]);
    }
}