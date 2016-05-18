<?php

namespace XtractaApi\Api\Document;

class Row
{
    public $fields = [];

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            if (is_array($jsonObject->field)) {
                foreach ($jsonObject->field as $fieldXml) {
                    $this->fields[] = new Field($fieldXml);
                }
            } else {
                $this->fields[] = new Field($jsonObject->field);
            }
        }
    }

    public function hasValueByField($fieldName) {
        foreach ($this->fields as $field) {
            if ($field->name == $fieldName) {
                return ('' != $field->value);
            }
        }

        return false;
    }

    public function getValueByField($fieldName, $default = '') {
        if ($this->hasValueByField($fieldName)) {
            foreach ($this->fields as $field) {
                if ($field->name == $fieldName) {
                    return $field->value;
                }
            }
        }

        return $default;
    }
}