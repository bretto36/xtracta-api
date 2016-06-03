<?php

namespace XtractaApi\Api\Tracking;

use XtractaApi\Api\AbstractResponse;

class GetResponse extends AbstractResponse
{
    public function getObject()
    {
        $responseObject = json_decode(json_encode($this->getResponse()));

        return new Input($responseObject->input);
    }
}