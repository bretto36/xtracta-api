<?php

namespace XtractaApi\Api\Database\Data;

use XtractaApi\Api\AbstractResponse;

/*
 * <databases_response>
 * <status>200</status>
 * <message>The request has been successfully processed</message>
 * <affected_records>1</affected_records>
 * <data>
 *  <row id="1"/>
 * </data>
 * </databases_response>

 */

class CreateResponse extends AbstractResponse
{
    public function getDataObject()
    {
        $simpleXml = $this->getResponse();

        return new Data(json_decode(json_encode($simpleXml)));
    }
}