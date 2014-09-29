<?php

namespace Http\Header\General;

class Factory
{
    /**
     * Factory for Request headers.
     *
     * @param string $field
     * @param string  $value
     * @return \Http\Header\Request
     */
    public static function create($field, $value)
    {
        switch ($field)
        {
            case \Http\Header\General::FIELD_DATE:

                return new Date($field, $value);

                break;

            default:

                return new \Http\Header\General($field, $value);

                break;
        }
    }
}