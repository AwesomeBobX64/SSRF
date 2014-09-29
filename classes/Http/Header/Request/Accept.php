<?php

namespace Http\Header\Request;

class Accept extends \Http\Header\Request
{
    use \Http\Header\HasWeightedList;

    /**
     * An array of acceptable content types.
     *
     * @var array
     */
    protected $_contentTypes = [];

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_contentTypes = $this->_getListFromValue();
    }

    /**
     * Returns content types sorted in decending preference.
     *
     * @return array (ie: ['text/html', 'image/webp', 'application/xhtml+xml', 'application/xml', ...])
     */
    public function getContentTypes()
    {
        return $this->_contentTypes;
    }
}