<?php

namespace XtractaApi\Api\Database\Data;

use XtractaApi\Api\AbstractRequest;

class DeleteRequest extends AbstractRequest
{
    protected $apiKey;

    protected $databaseId;

    protected $rowId;

    public function __construct($apiKey, $databaseId, $rowId)
    {
        $this->apiKey = $apiKey;
        $this->databaseId = $databaseId;
        $this->rowId = $rowId;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/databases/data_delete';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'database_id' => $this->databaseId,
            'row' => $this->rowId,
        );

        return $parameters;
    }
}