<?php

namespace Http\Header\Request\Authorization\Digest\Ha2;

class AuthInit extends Auth
{
    protected $_body;

    public function __construct($method, $uri, $body = NULL)
    {
        parent::__construct($method, $uri);

        $this->_body = $body;
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa1()
    {
        return md5($this->_method . ':' . $this->_uri . ':' . md5($this->_body));
    }
}