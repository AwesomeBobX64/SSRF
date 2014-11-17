<?php

namespace Http\Header\Response;

class WWWAuthenticate extends \Http\Header\Response
{
    const SCHEME_BASIC  = 'BASIC';
    const SCHEME_DIGEST = 'DIGEST';

    public static function createBasic($realm = NULL)
    {
        $value = ucfirst(strtolower(static::SCHEME_BASIC));

        if (!is_null($realm))
        {
            $value .= ' realm="' . addslashes($realm) . '"';
        }

        return new static(\Http\Header\Response::FIELD_WWW_AUTHENTICATE, $value);
    }

    public static function createDigest($realm, $nonce, $algorithm = NULL, $qop = NULL, $opaque = NULL)
    {
        $value = ucfirst(strtolower(static::SCHEME_DIGEST));
        $value .= ' realm="' . addslashes($realm) . '"';

        return new static(\Http\Header\Response::FIELD_WWW_AUTHENTICATE, $value);
    }
}