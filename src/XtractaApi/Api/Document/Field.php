<?php

namespace XtractaApi\Api\Document;

class Field
{
    public $id;

    public $name;

    public $value = '';

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id    = (int)$jsonObject->field_id;
            $this->name  = (string)$jsonObject->field_name;
            if (!is_object($jsonObject->field_value)) {
                $this->value = (string)$jsonObject->field_value;
            }
        }
    }
}