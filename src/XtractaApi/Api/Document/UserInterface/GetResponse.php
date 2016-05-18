<?php

namespace XtractaApi\Api\Document\UserInterface;

use XtractaApi\Api\AbstractResponse;

class GetResponse extends AbstractResponse
{
    public function getUserInterfaceObject()
    {
        return new UserInterface(json_decode(json_encode($this->getResponse())));
    }
}