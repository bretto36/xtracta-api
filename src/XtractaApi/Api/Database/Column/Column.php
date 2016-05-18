<?php

namespace XtractaApi\Api\Database\Column;

class Column
{
    public $id;

    public $name;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id   = (int)$jsonObject->column_id;
            $this->name = (string)$jsonObject->column_name;
        }
    }
}