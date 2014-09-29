<?php

namespace Http\Header;

class Request extends AbstractHeader
{
    const FIELD_ACCEPT              = 'ACCEPT';
    const FIELD_ACCEPT_CHARSET      = 'ACCEPT_CHARSET';
    const FIELD_ACCEPT_ENCODING     = 'ACCEPT_ENCODING';
    const FIELD_ACCEPT_LANGUAGE     = 'ACCEPT_LANGUAGE';
    const FIELD_AUTHORIZATION       = 'AUTHORIZATION';
    const FIELD_EXPECT              = 'EXPECT';
    const FIELD_FROM                = 'FROM';
    const FIELD_HOST                = 'HOST';
    const FIELD_IF_MATCH            = 'IF_MATCH';
    const FIELD_IF_MODIFIED_SINCE   = 'IF_MODIFIED_SINCE';
    const FIELD_IF_NONE_MATCH       = 'IF_NONE_MATCH';
    const FIELD_IF_RANGE            = 'IF_RANGE';
    const FIELD_IF_UNMODIFIED_SINCE = 'IF_UNMODIFIED_SINCE';
    const FIELD_PROXY_AUTHORIZATION = 'PROXY_AUTHORIZATION';
    const FIELD_REFERER             = 'REFERER';
    const FIELD_TE                  = 'TE';
    const FIELD_USER_AGENT          = 'USER_AGENT';
    const FIELD_VARY                = 'VARY';
}