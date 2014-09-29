<?php

namespace Http\Header;

class General extends AbstractHeader
{
    const FIELD_CACHE_CONTROL     = 'CACHE_CONTROL';
    const FIELD_CONNECTION        = 'CONNECTION';
    const FIELD_DATE              = 'DATE';
    const FIELD_PRAGMA            = 'PRAGMA';
    const FIELD_TRANSFER_ENCODING = 'TRANSFER_ENCODING';
    const FIELD_UPGRADE           = 'UPGRADE';
    const FIELD_VIA               = 'VIA';
    const FIELD_WARNING           = 'WARNING';
}