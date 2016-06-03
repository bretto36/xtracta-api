<?php

namespace XtractaApi\Api\Tracking;

class Input
{
    public $id;

    public $type;

    public $received;

    public $status;

    public $from;

    public $subject;

    public $files = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id   = (int)$jsonObject->id;
            $this->type = (string)$jsonObject->type;
            $this->received = (string)$jsonObject->received;
            $this->status = (string)$jsonObject->status;

            if (isset($jsonObject->file)) {
                if (is_array($jsonObject->file)) {
                    foreach ($jsonObject->file as $fileXml) {
                        $this->files[] = new File($fileXml);
                    }
                } else {
                    $this->files[] = new File($jsonObject->file);
                }
            }

            if (isset($jsonObject->subject)) {
                $this->subject = (string)$jsonObject->subject;
            }

            if (isset($jsonObject->from)) {
                $this->from = (string)$jsonObject->from;
            }
        }
    }
}