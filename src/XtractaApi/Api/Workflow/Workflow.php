<?php

namespace XtractaApi\Api\Workflow;

class Workflow
{
    public $id;

    public $name;

    public $email;

    public $file_transfer_url;

    public $source_id;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id                = (int)$jsonObject->workflow_id;
            $this->name              = (string)$jsonObject->workflow_name;
            $this->email             = (string)$jsonObject->workflow_email;
            $this->file_transfer_url = (string)$jsonObject->workflow_file_transfer;
            $this->source_id         = (int)$jsonObject->source_workflow_id;
        }
    }
}