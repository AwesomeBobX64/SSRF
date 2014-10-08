<?php

namespace Http\Header;

trait HasDateTime
{
    /**
     * A DateTime object which represents the value in the header.
     *
     * @var \DateTime
     */
    protected $_dateTime;

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_dateTime = new \DateTime;

        $this->_dateTime->setTimestamp(strtotime($value));
    }

    /**
     * Returns a DateTime object which represents the value in the header.
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->_dateTime;
    }
}