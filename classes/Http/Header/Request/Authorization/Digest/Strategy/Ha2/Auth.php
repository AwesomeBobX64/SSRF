<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha2;

class Auth implements iStrategy
{
    protected $_method;
    protected $_uri;

    public function __construct($method, $uri)
    {
        $this->_method = $method;
        $this->_uri    = $uri;
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa2()
    {
        return md5($this->_method . ':' . $this->_uri);
    }
}