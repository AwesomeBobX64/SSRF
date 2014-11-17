<?php

namespace Http\Header\Response\WWWAuthenticate;

class Basic extends AbstractWWWAuthenticate
{
    protected $_scheme = static::SCHEME_BASIC;

    public static function create($realm = NULL)
    {
        $value = 'Basic';

        if (!is_null($realm))
        {
            $value .= ' realm="' . addslashes($realm) . '"';
        }

        return new static(\Http\Header\Response::FIELD_WWW_AUTHENTICATE, $value);
    }
}