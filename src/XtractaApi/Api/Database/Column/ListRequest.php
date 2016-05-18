<?php

namespace XtractaApi\Api\Database\Column;

use XtractaApi\Api\AbstractRequest;

class ListRequest extends AbstractRequest
{
    protected $apiKey;

    protected $databaseId;

    public function __construct($apiKey, $databaseId)
    {
        $this->apiKey = $apiKey;
        $this->databaseId = $databaseId;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/databases/columns';
    }

    public function getParameters()
    {
        return array(
            'api_key' => $this->apiKey,
            'database_id' => $this->databaseId,
        );
    }
}