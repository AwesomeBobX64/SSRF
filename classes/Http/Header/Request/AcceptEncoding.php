<?php

namespace Http\Header\Request;

class AcceptEncoding extends \Http\Header\Request
{
    use \Http\Header\HasWeightedList;

    /**
     * An array of encodings
     *
     * @var array
     */
    protected $_encodings = [];

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_encodings = $this->_getListFromValue();
    }

    /**
     * Returns encodings sorted in decending preference.
     *
     * @return array (ie: ['gzip', 'deflate', ...])
     */
    public function getEncodings()
    {
        return $this->_encodings;
    }
}