<?php

namespace Http\Header\Request;

class AcceptLanguage extends \Http\Header\Request
{
    use \Http\Header\HasWeightedList;

    /**
     * An array of languages
     *
     * @var array
     */
    protected $_languages = [];

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_languages = $this->_getListFromValue();
    }

    /**
     * Returns languages sorted in decending preference.
     *
     * @return array (ie: ['en-US', 'en', ...])
     */
    public function getLanguages()
    {
        return $this->_languages;
    }
}