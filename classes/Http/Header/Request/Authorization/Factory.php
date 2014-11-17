<?php

namespace Http\Header\Request\Authorization;

class Factory
{
    const SCHEME_BASIC  = 'BASIC';
    const SCHEME_DIGEST = 'DIGEST';

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
            case static::SCHEME_BASIC:

                return new Basic($field, $value);

                break;

            case static::SCHEME_DIGEST:

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