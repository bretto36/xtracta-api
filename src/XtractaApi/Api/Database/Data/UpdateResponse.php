<?php

namespace XtractaApi\Api\Database\Data;

use XtractaApi\Api\AbstractResponse;

/*
 *
<?xml version="1.0" encoding="utf-8"?>
<databases_response>
    <status>200</status>
    <message>The request has been successfully processed</message>
    <affected_records>2</affected_records>
</databases_response>
 */

class UpdateResponse extends AbstractResponse
{
    public function getDataObject()
    {
        return new Data(json_decode(json_encode($this->getResponse())));
    }
}