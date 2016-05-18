<?php

namespace XtractaApi\Api\Provisioning;

use XtractaApi\Api\Workflow\Workflow;
use XtractaApi\Api\Database\Database;

class Provisioning
{
    public $group_id;

    public $group_name;

    public $api_key;

    public $workflows = array();

    public $databases = array();

    public function __construct($jsonObject = null)
    {
        if (null !== $jsonObject) {
            $this->group_id = (int)$jsonObject->group->group_id;
            $this->group_name = (string)$jsonObject->group->group_name;
            $this->api_key = (string)$jsonObject->api_key;

            if (is_array($jsonObject->workflow)) {
                foreach ($jsonObject->workflow as $workflowJson) {
                    $this->workflows[] = new Workflow($workflowJson);
                }
            } else {
                $this->workflows[] = new Workflow($jsonObject->workflow);
            }

            if (is_array($jsonObject->database)) {
                foreach ($jsonObject->database as $databaseJson) {
                    $this->databases[] = new Database($databaseJson);
                }
            } else {
                $this->databases[] = new Database($jsonObject->database);
            }
        }
    }
}