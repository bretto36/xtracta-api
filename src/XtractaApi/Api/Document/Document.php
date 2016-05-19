<?php

namespace XtractaApi\Api\Document;

class Document
{
    public $id;

    public $status;

    public $api_status;

    public $document_url;

    public $image_urls = array();

    public $fields = array();

    public $field_sets = array();

    public function __construct($jsonObject = null)
    {
        if ($jsonObject !== null) {
            $this->id   = (int)$jsonObject->document_id;
            $this->status = (string)$jsonObject->document_status;
            $this->api_status = (string)$jsonObject->api_download_status;
            $this->document_url = (string)$jsonObject->document_url;
            if (is_array($jsonObject->image_url)) {
                foreach ($jsonObject->image_url as $image_url) {
                    $this->image_urls[] = (string)$image_url;
                }
            } else {
                $this->image_urls[] = (string)$jsonObject->image_url;
            }

            if (is_array($jsonObject->field_data->field)) {
                foreach ($jsonObject->field_data->field as $fieldXml) {
                    $this->fields[] = new Field($fieldXml);
                }
            } else {
                $this->fields[] = new Field($jsonObject->field_data->field);
            }

            if (is_array($jsonObject->field_data->field_set)) {
                foreach ($jsonObject->field_data->field_set as $fieldSetXml) {
                    $this->field_sets[(string)$fieldSetXml->field_set_name] = new FieldSet($fieldSetXml);
                }
            } else {
                $this->field_sets[(string)$jsonObject->field_data->field_set->field_set_name] = new FieldSet($jsonObject->field_data->field_set);
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

    public function getFieldSetByName($fieldSetName)
    {
        if (isset($this->field_sets[$fieldSetName])) {
            return $this->field_sets[$fieldSetName];
        }

        return false;
    }

    public function getMeaningfulStatus()
    {
        switch ($this->status)
        {
            case 'reject':
                return 'Document requires training';
            case 'qa':
                return 'Document requires quality check';
            case 'output':
                return 'Ready for syncing';
            case 'api-ui-in-progress':
                return 'Updating after training';
        }

        return $this->status;
    }
}