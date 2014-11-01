<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Response;

class Auth extends Unspecified
{
    protected $_nonceCount;
    protected $_cnonce;
    protected $_qop;

    public function __construct($ha1, $ha2, $nonce, $nonceCount, $cnonce, $qop)
    {
        parent::__construct($ha1, $ha2, $nonce);

        $this->_nonceCount = $nonceCount;
        $this->_cnonce     = $cnonce;
        $this->_qop        = $qop;
    }

    public function calculateResponse()
    {
        return md5(implode(':', $this->_getHashArray()));
    }

    protected function _getHashArray()
    {
        return [$this->_ha1, $this->_nonce, $this->_nonceCount, $this->_cnonce, $this->_qop, $this->_ha2];
    }
}