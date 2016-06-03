<?php

namespace XtractaApi\Api\Tracking;

class TrackingResponses
{
    public $total = 0;

    public $page = 1;

    public $per_page;

    public $inputs = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->total    = (int)$jsonObject->items_matching_query;
            $this->page     = (int)$jsonObject->page;
            $this->per_page = (int)$jsonObject->items_per_page;

            if (is_array($jsonObject->input)) {
                foreach ($jsonObject->input as $inputXml) {
                    $this->inputs[] = new Input($inputXml);
                }
            } else {
                $this->inputs[] = new Input($jsonObject->input);
            }
        }
    }
}