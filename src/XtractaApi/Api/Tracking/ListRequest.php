<?php

namespace XtractaApi\Api\Tracking;

use XtractaApi\Api\AbstractRequest;

class ListRequest extends AbstractRequest
{
    protected $api_key;

    protected $workflow_id;

    protected $status;

    protected $type;

    protected $page;

    protected $per_page;

    protected $order;

    protected $timezone;

    protected $detailed;

    public function __construct($apiKey, $workflowId, $status, $type, $page, $perPage, $order, $timezone, $detailed)
    {
        $this->api_key = $apiKey;
        $this->workflow_id = $workflowId;
        $this->status = $status;
        $this->type = $type;
        $this->page = $page;
        $this->per_page = $perPage;
        $this->order = $order;
        $this->timezone = $timezone;
        $this->detailed = $detailed;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/tracking';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->api_key,
            'workflow_id' => $this->workflow_id,
        );

        if (null !== $this->status) {
            $parameters['status'] = $this->status;
        }

        if (null !== $this->type) {
            $parameters['type'] = $this->type;
        }

        if (null !== $this->page) {
            $parameters['page'] = $this->page;
        }

        if (null !== $this->per_page) {
            $parameters['items_per_page'] = $this->per_page;
        }

        if (null !== $this->order) {
            $parameters['order'] = $this->order;
        }

        if (null !== $this->timezone) {
            $parameters['timezone'] = $this->timezone;
        }

        if ($this->detailed) {
            $parameters['detailed'] = 1;
        }

        return $parameters;
    }
}