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
            case \Http\Header\Entity::FIELD_ALLOW:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_ENCODING:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_LANGUAGE:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_LENGTH:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_LOCATION:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_MD5:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_RANGE:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_CONTENT_TYPE:
                // FALL THROUGH
            case \Http\Header\Entity::FIELD_EXPIRES:

                return new \Http\Header\Entity($field, $value);

                break;

            case \Http\Header\Entity::FIELD_LAST_MODIFIED:

                return new LastModified($field, $value);

                break;

            default:

                throw new \InvalidArgumentException('Invalid field name: ' . $field);

                break;
        }
    }
}