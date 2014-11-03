<?php

namespace Http\Header\Request\Authorization\Digest\Strategy;

use \Http\Exception;

class Ha1
{
    const ALGORITHM_MD5      = 'MD5';
    const ALGORITHM_MD5_SESS = 'MD5-SESS';

    /**
     * Returns a strategy for calculating HA1 in Digest authentication.
     *
     * @param string $algorithm The algorithm which specifies which strategy to use (e.g. "md5", "md5-sess" or NULL).
     * @param string $username The username to authorize.
     * @param string $realm The realm the authorization is good for.
     * @param string $password Used for authorization.
     * @param string $nonce A server generated random string.
     * @param string $cnonce A client generated random string.
     * @throws \UnexpectedValueException Thrown if an unknown, non NULL algorithm value is passed.
     * @return Ha1\iStrategy
     */
    protected static function _getStrategy($algorithm, $username, $realm, $password, $nonce = NULL, $cnonce = NULL)
    {
        $algorithmUpper = strtoupper($algorithm);

        if (is_null($algorithm) || static::ALGORITHM_MD5 == $algorithmUpper)
        {
            return new Ha1\Md5($username, $realm, $password);
        }
        elseif (static::ALGORITHM_MD5 == $algorithmUpper)
        {
            return new Ha1\Md5Sess($username, $realm, $password, $nonce, $cnonce);
        }
        else
        {
            throw new \UnexpectedValueException('Unknown algorithm: ' . $algorithm, Exception::CODE_BAD_REQUEST);
        }
    }

    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @param array $credentials An array of digest credentials.
     * @param string $password A password value used to compute the HA1 hash.
     * @return string
     */
    public static function getHa1($credentials, $password, $nonce)
    {
        $algorithm = isset_or($credentials['algorithm']);
        $username  = isset_or($credentials['username']);
        $realm     = isset_or($credentials['realm']);
        $cnonce    = isset_or($credentials['cnonce']);
        $ha1       = static::_getStrategy($algorithm, $username, $realm, $password, $nonce, $cnonce);

        return $ha1->calculateHa1();
    }
}