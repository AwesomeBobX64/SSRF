<?php

namespace Http\Header;

class AbstractHeader
{
    /**
     * The header field name.
     *
     * @var string
     */
    protected $_field;
    /**
     * The header value.
     *
     * @var string
     */
    protected $_value;

    /**
     * Create a new header.
     *
     * @param string $field The header field name.
     * @param string $value The header value.
     */
    public function __construct($field, $value)
    {
        $this->_setField($field);
        $this->_setValue($value);
    }

    protected function _setField($field)
    {
        $words = array_map(function($word)
        {
            return ucfirst(strtolower($word));
        }, explode('_', $field));

        $this->_field = implode('-', $words);
    }

    protected function _setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * Returns the header field name.
     *
     * @return string
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * Returns the header value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }
}