<?php

namespace Http\Header\Entity;

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
            case \Http\Header\Entity::FIELD_LAST_MODIFIED:

                return new LastModified($field, $value);

                break;

            default:

                return new \Http\Header\Entity($field, $value);

                break;
        }
    }
}