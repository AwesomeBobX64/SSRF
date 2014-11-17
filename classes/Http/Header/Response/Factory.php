<?php

namespace Http\Header\Response;

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
            case \Http\Header\Response::FIELD_ACCEPT_RANGES:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_AGE:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_ETAG:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_LOCATION:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_PROXY_AUTHENTICATE:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_RETRY_AFTER:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_SERVER:
				// FALL THROUGH
            case \Http\Header\Response::FIELD_WWW_AUTHENTICATE:

                return new \Http\Header\Response($field, $value);

                break;
        }
    }
}