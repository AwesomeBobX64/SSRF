<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Ha2;

interface iStrategy
{
    /**
     * Calculates HA1
     *
     * @return string
     */
    public function calculateHa2();
}