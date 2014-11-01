<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

class Ha1
{
    const ALGORITHM_MD5      = 'MD5';
    const ALGORITHM_MD5_SESS = 'MD5-SESS';

    /**
     * Returns a strategy for calculating HA1 in Digest authentication.
     *
     * @param string $algorithm The algorithm which specifies which strategy to use (e.g. "md5" or "md5-sess").
     * @param string $username The username to authorize.
     * @param string $realm The realm the authorization is good for.
     * @param string $password Used for authorization.
     * @param string $nonce A server generated random string.
     * @param string $cnonce A client generated random string.
     * @return Ha1\iStrategy
     */
    public static function getStrategy($algorithm, $username, $realm, $password, $nonce = NULL, $cnonce = NULL)
    {
        switch ($algorithm)
        {
            case static::ALGORITHM_MD5_SESS:

                return new Ha1\Md5Sess($username, $realm, $password, $nonce, $cnonce);

                break;

            case static::ALGORITHM_MD5:
                // FALL THROUGH
            default:

                return new Ha1\Md5($username, $realm, $password);

                break;
        }
    }
}