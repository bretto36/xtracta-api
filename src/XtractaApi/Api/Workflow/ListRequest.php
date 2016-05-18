<?php

namespace XtractaApi\Api\Workflow;

use XtractaApi\Api\AbstractRequest;

class ListRequest extends AbstractRequest
{
    protected $apiKey;

    protected $groupId;

    public function __construct($apiKey, $groupId)
    {
        $this->apiKey = $apiKey;
        $this->groupId = $groupId;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/workflow';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'group_id' => $this->groupId,
        );

        return $parameters;
    }
}