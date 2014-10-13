<?php

namespace Http\Header\Request\Authorization;

class Factory
{
    /**
     * Factory for Request\Authorization headers.
     *
     * @param string $field
     * @param string  $value
     * @return \Http\Header\Request
     */
    public static function create($field, $value)
    {
        switch (static::_getSchemeFromValue($value))
        {
            case \Http\Header\Request\AbstractAuthorization::SCHEME_BASIC:

                return new Basic($field, $value);

                break;

            case \Http\Header\Request\AbstractAuthorization::SCHEME_DIGEST:

                return new Digest($field, $value);

                break;
        }
    }

    protected static function _getSchemeFromValue($value)
    {
        $pieces = explode(' ',  $value);

        return strtoupper($pieces[0]);
    }
}