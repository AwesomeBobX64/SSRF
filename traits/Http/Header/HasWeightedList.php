<?php

namespace Http\Header;

trait HasWeightedList
{
    /**
     * Parses raw header values into a sorted list.
     *
     * @return array
     */
    protected function _getListFromValue()
    {
        $headers = preg_split('/,\s*?/', $this->getValue());

        usort($headers, [$this, '_sortByWeight']);

        return array_reverse($this->_stripWeights($headers));
    }

    /**
     * Custom sort function for sorting
     *
     * @param string $contentTypeA
     * @param string $contentTypeB
     * @return number
     */
    protected function _sortByWeight($headerA, $headerB)
    {
        $aWeight = $this->_getWeight($headerA);
        $bWeight = $this->_getWeight($headerB);

        if ($aWeight == $bWeight) return 0;

        return ($aWeight > $bWeight) ? 1 : -1;
    }

    /**
     * Separates a raw header value from it's qvalue weight and returns the weight.
     *
     * @param string $header
     * @return number
     */
    protected function _getWeight($header)
    {
        $pieces = explode(';q=', $header);

        return (count($pieces) == 1) ? 1 : (double) $pieces[1];
    }

    /**
     * Removes qvalues from content types.
     */
    protected function _stripWeights($rawHeaders)
    {
        return array_map([$this, '_stripWeight'], $rawHeaders);
    }

    /**
     * Separates a raw header from it's qvalue and returns the content type.
     *
     * @param string $rawContentType (ie: 'text/html;q=8.0')
     * @return string
     */
    protected function _stripWeight($rawHeader)
    {
        $pieces = explode(';', $rawHeader);

        return array_shift($pieces);
    }
}