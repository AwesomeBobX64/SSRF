<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha1;

interface iStrategy
{
    /**
     * Calculates HA1, a 32 character string for digest authentication.
     *
     * @return string
     */
    public function calculateHa1();
}