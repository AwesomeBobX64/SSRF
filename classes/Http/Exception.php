<?php

namespace Http;

class Exception extends \Exception
{
    const CODE_INTERNAL_SERVER_ERROR      = 500;
    const CODE_NOT_IMPLEMENTED            = 501;
    const CODE_HTTP_VERSION_NOT_SUPPORTED = 505;
}