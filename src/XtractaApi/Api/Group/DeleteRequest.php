<?php

namespace XtractaApi\Api\Group;

use XtractaApi\Api\AbstractRequest;

class DeleteRequest extends AbstractRequest
{
    protected $api_key;

    protected $group_id;

    public function __construct($apiKey, $groupId)
    {
        $this->api_key = $apiKey;
        $this->group_id = $groupId;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/group/delete ';
    }

    public function getParameters()
    {
        return array(
            'api_key' => $this->api_key,
            'group_id' => $this->group_id,
        );
    }
}