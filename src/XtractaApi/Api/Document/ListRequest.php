<?php

namespace XtractaApi\Api\Document;

use XtractaApi\Api\AbstractRequest;

class ListRequest extends AbstractRequest
{
    protected $api_key;

    protected $workflow_id;

    protected $status;

    protected $api_status;

    protected $detailed;

    protected $per_page;

    public function __construct($apiKey, $workflowId, $status = null, $apiStatus = 'active', $detailed = true, $perPage = 1000)
    {
        $this->api_key = $apiKey;
        $this->workflow_id = $workflowId;
        $this->status = $status;
        $this->api_status = $apiStatus;
        $this->detailed = $detailed;
        $this->per_page = $perPage;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/documents';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->api_key,
            'workflow_id' => $this->workflow_id,
        );

        if (null !== $this->status) {
            $parameters['document_status'] = $this->status;
        }

        if (null !== $this->api_status) {
            $parameters['api_download_status'] = $this->api_status;
        }

        if ($this->detailed) {
            $parameters['detailed'] = 1;
        }

        $parameters['items_per_page'] = $this->per_page;

        return $parameters;
    }
}