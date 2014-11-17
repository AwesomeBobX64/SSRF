<?php

namespace Http\Header\Request\Authorization;

abstract class AbstractAuthorization extends \Http\Header\Request
{
    protected $_scheme;
    protected $_credentials;

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $pieces = explode(' ', $this->getValue());

        $this->_scheme      = strtoupper($pieces[0]);
        $this->_credentials = $this->_getCredentialsFromValue($pieces[1]);
    }

    public function getScheme()
    {
        return $this->_scheme;
    }

    public function getCredentials()
    {
        return $this->_credentials;
    }

    /**
     * Receives a credential string and returns an array of credentials.
     *
     * @param string $credentialString
     * @return array
     */
    abstract protected function _getCredentialsFromValue($credentialString);
}