<?php

namespace XtractaApi\Api\Database\Column;

use XtractaApi\Api\AbstractRequest;
use XtractaApi\Api\AbstractResponse;

class ListResponse extends AbstractResponse
{
    public function __construct(AbstractRequest $request)
    {
        parent::__construct($request);
    }

    public function getColumns()
    {
        $column = array();

        return $column;
    }
}