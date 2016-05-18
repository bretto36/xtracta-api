<?php

namespace XtractaApi\Api\Workflow;

use XtractaApi\Api\AbstractRequest;

class GetRequest extends AbstractRequest
{
    protected $apiKey;

    protected $workflowId;

    public function __construct($apiKey, $workflowId)
    {
        $this->apiKey = $apiKey;
        $this->workflowId = $workflowId;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/workflow';
    }

    public function getParameters()
    {
        return array(
            'api_key' => $this->apiKey,
            'workflow_id' => $this->workflowId,
        );
    }
}