<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha1;

interface iStrategy
{
    /**
     * Calculates HA1
     *
     * @return string
     */
    public function calculateHa1();
}