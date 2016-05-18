<?php

namespace XtractaApi\Api\Database\Data;

class Row
{
    public $id;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id = $jsonObject->{'@attributes'}->id;
        }
    }
}