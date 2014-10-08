<?php

namespace Http\Header\Request;

class TE extends \Http\Header\Request
{
    use \Http\Header\HasPriorityQueue;

    const ENCODING_CHUNKED  = 'chunked';
    const ENCODING_COMPRESS = 'compress';
    const ENCODING_DEFLATE  = 'deflate';
    const ENCODING_GZIP     = 'gzip';
    const ENCODING_TRAILERS = 'trailers';
}