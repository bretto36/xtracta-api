<?php

namespace XtractaApi\Api\Provisioning;

use XtractaApi\Api\AbstractResponse;

/*
 * <?xml version="1.0" encoding="utf-8"?>
<provisioning_response>
    <status>200</status>
    <message>The request has been successfully processed</message>
    <group>
        <group_id></group_id>
        <group_name></group_name>
    </group>
    <billing_plan/>
    <workflow>
        <workflow_id></workflow_id>
        <workflow_name></workflow_name>
        <workflow_email></workflow_email>
        <workflow_file_transfer></workflow_file_transfer>
        <source_workflow_id></source_workflow_id>
    </workflow>
    <database>
        <database_id></database_id>
        <database_name></database_name>
        <column>
            <column_id></column_id>
            <column_name></column_name>
        </column>
        <column>
            <column_id></column_id>
            <column_name></column_name>
        </column>
    </database>
    <database>
        <database_id></database_id>
        <database_name></database_name>
        <column>
            <column_id></column_id>
            <column_name></column_name>
        </column>
        <column>
            <column_id></column_id>
            <column_name></column_name>
        </column>
    </database>
    <api_key></api_key>
</provisioning_response>
 */

class CreateResponse extends AbstractResponse
{
    public function getProvisioningObject()
    {
        return new Provisioning(json_decode(json_encode($this->getResponse())));
    }
}