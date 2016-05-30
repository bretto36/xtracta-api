<?php

namespace XtractaApi\Api\Document;

class Rejection
{
    public $message;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->message = (string)$jsonObject->message;
        }
    }
}