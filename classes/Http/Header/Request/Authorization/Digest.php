<?php

namespace Http\Header\Request\Authorization;

class Basic extends \Http\Header\Request\AbstractAuthorization
{
    protected function _getCredentialsFromValue($credentialString)
    {
        // Needs to be implemented
    }
}