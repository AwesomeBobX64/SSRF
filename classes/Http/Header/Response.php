<?php

namespace Http\Header;

class Response extends AbstractHeader
{
    const FIELD_ACCEPT_RANGES      = 'ACCEPT_RANGES';
    const FIELD_AGE                = 'AGE';
    const FIELD_ETAG               = 'ETAG';
    const FIELD_LOCATION           = 'LOCATION';
    const FIELD_PROXY_AUTHENTICATE = 'PROXY_AUTHENTICATE';
    const FIELD_RETRY_AFTER        = 'RETRY_AFTER';
    const FIELD_SERVER             = 'SERVER';
    const FIELD_WWW_AUTHENTICATE   = 'WWW_AUTHENTICATE';
}