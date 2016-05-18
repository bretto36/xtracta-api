<?php

namespace XtractaApi\Api\Document;

use XtractaApi\Api\AbstractResponse;

class ListResponse extends AbstractResponse
{
    public function getDocumentsObject()
    {
        return new Documents(json_decode(json_encode($this->getResponse())));
    }
}