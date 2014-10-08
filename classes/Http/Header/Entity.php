<?php

namespace Http\Header;

class Entity extends AbstractHeader
{
    const FIELD_ALLOW            = 'ALLOW';
    const FIELD_CONTENT_ENCODING = 'CONTENT_ENCODING';
    const FIELD_CONTENT_LANGUAGE = 'CONTENT_LANGUAGE';
    const FIELD_CONTENT_LENGTH   = 'CONTENT_LENGTH';
    const FIELD_CONTENT_LOCATION = 'CONTENT_LOCATION';
    const FIELD_CONTENT_MD5      = 'CONTENT_MD5';
    const FIELD_CONTENT_RANGE    = 'CONTENT_RANGE';
    const FIELD_CONTENT_TYPE     = 'CONTENT_TYPE';
    const FIELD_EXPIRES          = 'EXPIRES';
    const FIELD_LAST_MODIFIED    = 'LAST_MODIFIED';
}