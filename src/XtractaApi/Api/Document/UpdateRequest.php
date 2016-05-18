<?php

namespace XtractaApi\Api\Document;

use XtractaApi\Api\AbstractRequest;

class UpdateRequest extends AbstractRequest
{
    protected $api_key;

    protected $document_id;

    protected $status;

    protected $api_status;

    protected $reason;

    protected $free_form;

    public function __construct($apiKey, $documentId, $status = null, $apiStatus = null, $reason = null, $freeForm = null)
    {
        $this->api_key = $apiKey;
        $this->document_id = $documentId;
        $this->status = $status;
        $this->api_status = $apiStatus;
        $this->reason = $reason;
        $this->free_form = $freeForm;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/documents/update';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->api_key,
            'document_id' => $this->document_id,
        );

        if (null !== $this->status) {
            $parameters['document_status'] = $this->status;
        }

        if (null !== $this->api_status) {
            $parameters['api_download_status'] = $this->api_status;
        }

        if (null !== $this->api_status) {
            $parameters['reason'] = $this->reason;
        }

        if (null !== $this->free_form) {
            $parameters['free_form'] = $this->free_form;
        }

        return $parameters;
    }
}