<?php

namespace XtractaApi\Api\Tracking;

use XtractaApi\Api\AbstractRequest;

class GetRequest extends AbstractRequest
{
    protected $api_key;

    protected $document_id;

    protected $timezone;

    public function __construct($apiKey, $documentId, $timezone = null)
    {
        $this->api_key = $apiKey;
        $this->document_id = $documentId;
        $this->timezone = $timezone;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/tracking';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->api_key,
            'document_id' => $this->document_id,
        );

        if (null !== $this->timezone) {
            $parameters['timezone'] = $this->timezone;
        }

        return $parameters;
    }
}