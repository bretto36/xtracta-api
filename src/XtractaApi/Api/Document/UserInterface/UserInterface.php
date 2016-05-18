<?php

namespace XtractaApi\Api\Document\UserInterface;

class UserInterface
{
    public $url;

    public $expires;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->url     = (string)$jsonObject->url;
            $this->expires = (int)$jsonObject->expire;
        }
    }
}