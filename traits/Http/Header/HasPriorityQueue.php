<?php

namespace Http\Header;

trait HasPriorityQueue
{
    /**
     * A list of header values, sorted by their qvalue.
     *
     * @var \SplPriorityQueue
     */
    protected $_priorityQueue;

    protected function _setValue($value)
    {
        parent::_setValue($value);

        $this->_getListFromValue($value);
    }

    /**
     * Parses raw header values into a sorted list.
     *
     * @return \SplPriorityQueue
     */
    protected function _getListFromValue($value)
    {
        $this->_priorityQueue = new \SplPriorityQueue();

        foreach (preg_split('/,\s*?/', $value) as $token)
        {
            $pieces   = preg_split('/;\s*?q=/', $token);
            $priority = (count($pieces) == 1) ? 1 : (double) $pieces[1];

            $this->_priorityQueue->insert($pieces[0], $priority);
        }
    }

    /**
     * Returns a prioritized list of values.
     *
     * @return \SplPriorityQueue
     */
    public function getList()
    {
        return $this->_priorityQueue;
    }
}