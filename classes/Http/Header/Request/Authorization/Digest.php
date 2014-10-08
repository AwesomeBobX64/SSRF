<?php

namespace Http\Header\Request\Authorization;

class Basic extends \Http\Header\Request\AbstractAuthorization
{
    protected function _getCredentialsFromValue($credentialString)
    {
        $decoded = base64_decode($credentialString);
        $pieces  = explode(':', $decoded);

        return ['userid' => $pieces[0], 'password' => $pieces[1]];
    }
}