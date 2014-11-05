<?php

namespace Http\Header\Request\Authorization\Digest\Ha2;

interface iStrategy
{
    /**
     * Calculates HA2, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa2();
}