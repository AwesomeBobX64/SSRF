<?php

namespace Http\Header\Request\Authorization\Digest\Response;

class Unspecified implements iStrategy
{
    protected $_ha1;
    protected $_ha2;
    protected $_nonce;

    public function __construct($ha1, $ha2, $nonce)
    {
        $this->_ha1   = $ha1;
        $this->_ha2   = $ha2;
        $this->_nonce = $nonce;
    }

    public function calculateResponse()
    {
        return md5($this->_ha1 . ':' . $this->_nonce . ':' . $this->_ha2);
    }
}