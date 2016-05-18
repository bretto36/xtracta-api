<?php

namespace XtractaApi\Api\Database\Data;

class Data
{
    public $rows = array();

    public $rows_affected;

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->rows_affected = $jsonObject->affected_records;

            if (isset($jsonObject->data)) {
                if (is_array($jsonObject->data->row)) {
                    foreach ($jsonObject->data->row as $rowJson) {
                        $this->rows[] = new Row($rowJson);
                    }
                } else {
                    $this->rows[] = new Row($jsonObject->data->row);
                }
            }
        }
    }
}