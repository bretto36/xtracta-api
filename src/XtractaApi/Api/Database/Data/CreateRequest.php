<?php

namespace XtractaApi\Api\Database\Data;

use XtractaApi\Api\AbstractRequest;

class CreateRequest extends AbstractRequest
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
        return $this->getBaseUrl() . 'v1/databases/data_add';
    }

    public function getParameters()
    {
        $parameters = array(
            'api_key' => $this->apiKey,
            'database_id' => $this->databaseId,
        );

        $data = array();

        foreach ($this->rows as $row) {
            $columns = array();
            foreach ($row as $key => $value) {
                $columns[] = '<column name="' . $key . '">' . ('' != $value ? '<![CDATA[' . $value . ']]>' : '') . '</column>';
            }

            $data[] = '<row>' . implode('', $columns) . '</row>';
        }

        $parameters['data'] = '<xml>' . implode('', $data) . '</xml>';

        return $parameters;
    }
}