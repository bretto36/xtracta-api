<?php

namespace XtractaApi\Api\Database;

use XtractaApi\Api\Database\Column\Column;

class Database
{
    public $id;

    public $name;

    public $columns = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id   = (int)$jsonObject->database_id;
            $this->name = (string)$jsonObject->database_name;

            if (is_array($jsonObject->column)) {
                foreach ($jsonObject->column as $columnXml) {
                    $this->columns[] = new Column($columnXml);
                }
            } else {
                $this->columns[] = new Column($jsonObject->column);
            }
        }
    }
}