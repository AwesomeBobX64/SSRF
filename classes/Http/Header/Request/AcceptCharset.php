<?php

namespace Http\Header\Request;

class AcceptCharset extends \Http\Header\Request
{
    use \Http\Header\HasWeightedList;

    /**
     * An array of character sets
     *
     * @var array
     */
    protected $_charsets = [];

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_charsets = $this->_getListFromValue();
    }

    /**
     * Returns encodings sorted in decending preference.
     *
     * @return array (ie: ['iso-8859-1', 'unicode-1-1', ...])
     */
    public function getCharsets()
    {
        return $this->_charsets;
    }
}