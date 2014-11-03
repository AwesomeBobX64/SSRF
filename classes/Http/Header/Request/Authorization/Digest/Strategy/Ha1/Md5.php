<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha1;

class Md5 implements iStrategy
{
    protected $_username;
    protected $_realm;
    protected $_password;

    public function __construct($username, $realm, $password)
    {
        $this->_username = $username;
        $this->_realm    = $realm;
        $this->_password = $password;
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa1()
    {
        return md5($this->_username . ':' . $this->_realm . ':' . $this->_password);
    }
}