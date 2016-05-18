<?php

namespace XtractaApi\Api\Document;

class Documents
{
    public $total = 0;

    public $page = 1;

    public $per_page;

    public $documents = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->total    = (int)$jsonObject->documents_matching_query;
            $this->page     = (int)$jsonObject->page;
            $this->per_page = (int)$jsonObject->items_per_page;

            if (is_array($jsonObject->document)) {
                foreach ($jsonObject->document as $documentXml) {
                    $this->documents[] = new Document($documentXml);
                }
            } else {
                $this->documents[] = new Document($jsonObject->document);
            }
        }
    }
}