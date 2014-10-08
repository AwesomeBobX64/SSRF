<?php

require '../includes/bootstrap.php';

$request = \Http\Message\Request::create();

foreach ($request->getHeaders() as $field => $header)
{
    if ($field == \Http\Header\Request::FIELD_ACCEPT)
    {
        $contentTypes = $header->getList();

        while ($contentTypes->valid())
        {
            var_dump($contentTypes->extract());
        }
    }
}