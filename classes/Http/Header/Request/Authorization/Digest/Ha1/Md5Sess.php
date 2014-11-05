<?php

namespace Http\Header\Request\Authorization\Digest\Ha1;

class Md5Sess extends Md5
{
    protected $_nonce;
    protected $_cnonce;

    public function __construct($username, $realm, $password, $nonce, $cnonce)
    {
        parent::__construct($username, $realm, $password);

        $this->_nonce  = $nonce;
        $this->_cnonce = $cnonce;
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa1()
    {
        return md5(parent::calculateHa1() . ':' . $this->_nonce . ':' . $this->_cnonce);
    }
}