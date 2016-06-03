<?php

namespace XtractaApi\Api\Tracking;

class Activity
{
    public $description;

    public $username;

    public $date;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->description = (string)$jsonObject->description;
            $this->username    = (string)$jsonObject->username;
            $this->date        = (string)$jsonObject->time;
        }
    }
}