<?php

namespace Http\Header\Request;

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
            case \Http\Header\Request::FIELD_ACCEPT:

                return new Accept($field, $value);

                break;

            case \Http\Header\Request::FIELD_ACCEPT_CHARSET:

                return new AcceptCharset($field, $value);

                break;

            case \Http\Header\Request::FIELD_ACCEPT_ENCODING:

                return new AcceptEncoding($field, $value);

                break;

            case \Http\Header\Request::FIELD_ACCEPT_LANGUAGE:

                return new AcceptLanguage($field, $value);

                break;

            default:

                return new \Http\Header\Request($field, $value);

                break;
        }
    }
}