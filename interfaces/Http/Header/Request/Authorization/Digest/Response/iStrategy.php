<?php

namespace Http\Header\Request\Authorization\Digest\Response;

interface iStrategy
{
    /**
     * Calculates Response, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateResponse();
}