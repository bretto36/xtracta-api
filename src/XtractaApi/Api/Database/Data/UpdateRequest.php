<?php

namespace XtractaApi\Api\Database\Data;

use XtractaApi\Api\AbstractRequest;

class UpdateRequest extends AbstractRequest
{
    protected $apiKey;

    protected $databaseId;

    protected $rows;

    public function __construct($apiKey, $databaseId, $rows = array())
    {
        $this->apiKey = $apiKey;
        $this->databaseId = $databaseId;
        $this->rows = $rows;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . 'v1/databases/data_update';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'database_id' => $this->databaseId,
        );

        $data = array();

        foreach ($this->rows as $rowId => $row) {
            $columns = array();
            foreach ($row as $key => $value) {
                $columns[] = '<column name="' . $key . '">' . ('' != $value ? '<![CDATA[' . $value . ']]>' : '') . '</column>';
            }

            $data[] = '<row id="' . $rowId . '">' . implode('', $columns) . '</row>';
        }

        $parameters['data'] = '<xml>' . implode('', $data) . '</xml>';

        return $parameters;
    }
}