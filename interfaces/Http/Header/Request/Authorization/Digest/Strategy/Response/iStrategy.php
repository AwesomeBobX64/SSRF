<?php

namespace Http\Header\Request\Authorization\Digest\Strategy\Response;

interface iStrategy
{
    /**
     * Calculates HA1
     *
     * @return string
     */
    public function calculateResponse();
}