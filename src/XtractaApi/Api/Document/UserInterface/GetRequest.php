<?php

namespace XtractaApi\Api\Document\UserInterface;

use XtractaApi\Api\AbstractRequest;

class GetRequest extends AbstractRequest
{
    protected $apiKey;

    protected $documentId;

    protected $callbackUrl;

    protected $expires;

    protected $afterApiDownloadStatus;

    public function __construct($apiKey, $documentId, $callbackUrl = '', $expires = 600, $afterApiDownloadStatus = null)
    {
        $this->apiKey                 = $apiKey;
        $this->documentId             = $documentId;
        $this->callbackUrl            = $callbackUrl;
        $this->expires                = $expires;
        $this->afterApiDownloadStatus = $afterApiDownloadStatus;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/documents/ui';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'document_id' => $this->documentId,
            'expire' => $this->expires,
        );

        if (null !== $this->callbackUrl && '' !== $this->callbackUrl) {
            $parameters['callback_url'] = $this->callbackUrl;
        }

        if (null !== $this->afterApiDownloadStatus) {
            $parameters['after_api_download_status'] = 1;
        }

        return $parameters;
    }
}