<?php

namespace XtractaApi\Api\Tracking;

class File
{
    public $id;

    public $name;

    public $url;

    public $status;

    public $activities = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id     = (int)$jsonObject->document_id;
            $this->name   = (string)$jsonObject->filename;
            $this->status = (string)$jsonObject->status;
            $this->url    = (string)$jsonObject->file_url;

            if (isset($jsonObject->activity)) {
                if (is_array($jsonObject->activity)) {
                    foreach ($jsonObject->activity as $activityXml) {
                        $this->activities[] = new Activity($activityXml);
                    }
                } else {
                    $this->activities[] = new Activity($jsonObject->activity);
                }
            }
        }
    }
}