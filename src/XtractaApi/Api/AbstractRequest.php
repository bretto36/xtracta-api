<?php

namespace XtractaApi\Api;

abstract class AbstractRequest
{
    abstract public function getUrl();

    abstract public function getParameters();

    public function getMethod()
    {
        return 'POST';
    }

    public function getBaseUrl()
    {
        return 'https://api-app.xtracta.com/';
    }
}