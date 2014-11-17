<?php

namespace Http\Header\Request\Authorization;

class Basic extends AbstractAuthorization
{
    protected function _getCredentialsFromValue($credentialString)
    {
        $decoded = base64_decode($credentialString);
        $pieces  = explode(':', $decoded);

        return ['userid' => $pieces[0], 'password' => $pieces[1]];
    }

    public function isAuthorized($password)
    {
        $credentials = $this->getCredentials();

        return $credentials['password'] == $password;
    }
}