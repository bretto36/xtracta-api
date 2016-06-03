<?php

namespace XtractaApi\Api\Tracking;

use XtractaApi\Api\AbstractResponse;

class ListResponse extends AbstractResponse
{
    public function getObject()
    {
        return new TrackingResponses(json_decode(json_encode($this->getResponse())));
    }
}