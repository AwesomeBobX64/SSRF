<?php

namespace Http\Header\Request;

class Authorization extends \Http\Header\Request
{
    protected $_scheme;
    protected $_credentials;

    const SCHEME_BASIC = 'BASIC';

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $pieces = explode(' ', $this->getValue());

        $this->_scheme = strtoupper($pieces[0]);

        switch (strtoupper($this->_scheme))
        {
            case static::SCHEME_BASIC:

                $this->_credentials = $this->_getBasicCredentialsFromValue($pieces[1]);

                break;
        }
    }

    protected function _getBasicCredentialsFromValue($credentialString)
    {
        $decoded = base64_decode($credentialString);
        $pieces  = explode(':', $decoded);

        return ['userid' => $pieces[0], 'password' => $pieces[1]];
    }

    public function getCredentials()
    {
        return $this->_credentials;
    }
}