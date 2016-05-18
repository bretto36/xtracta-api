<?php

namespace XtractaApi\Api\Provisioning;

use XtractaApi\Api\AbstractRequest;

class CreateRequest extends AbstractRequest
{
    protected $apiKey;

    protected $profileId;

    protected $identifier;

    protected $name;

    public function __construct($apiKey, $profileId, $identifier, $name = '')
    {
        $this->apiKey = $apiKey;
        $this->profileId = $profileId;
        $this->identifier = $identifier;
        $this->name = $name;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/provisioning/provision';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'profile_id' => $this->profileId,
            'identifier' => $this->identifier,
        );

        if ('' !== $this->name) {
            $parameters['name'] = $this->name;
        }

        return $parameters;
    }
}