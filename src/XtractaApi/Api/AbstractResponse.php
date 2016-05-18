<?php

namespace XtractaApi\Api;

abstract class AbstractResponse
{
    protected $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return simplexml_load_string($this->response->getBody());
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}