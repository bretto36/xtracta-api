<?php

namespace XtractaApi\Api\Document;

class FieldSet
{
    public $id;

    public $name;

    public $rows = [];

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id    = (int)$jsonObject->field_set_id;
            $this->name  = (string)$jsonObject->field_set_name;
            if (is_array($jsonObject->row)) {
                foreach ($jsonObject->row as $rowXml) {
                    $this->rows[] = new Row($rowXml);
                }
            } else {
                $this->rows[] = new Row($jsonObject->row);
            }
        }
    }
}