<?php


namespace XtractaApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use XtractaApi\Api\AbstractRequest;
use XtractaApi\Api\Document\Documents;

/**
 * Class API
 *
 * @package XtractaApi
 */
class XtractaApi
{
    public $client = null;

    /**
     * Checks for presence of setup $data array and loads
     *
     * @param bool $data
     */
    public function __construct($parameters = array())
    {
        if (isset($parameters['client'])) {
            $this->client = $parameters['client'];
        }
    }

    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new Client();
        }

        return $this->client;
    }

    public function provisionUser($apiKey, $profileId, $identifier, $name = '')
    {
        $requestObject = new \XtractaApi\Api\Provisioning\CreateRequest($apiKey, $profileId, $identifier, $name);

        $response = $this->call($requestObject);

        $responseObject = new \XtractaApi\Api\Provisioning\CreateResponse($response);

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getProvisioningObject();
        }

        // Check for errors
        return false;
    }

    public function addData($apiKey, $databaseId, array $data)
    {
        $requestObject = new \XtractaApi\Api\Database\Data\CreateRequest($apiKey, $databaseId, $data);

        $response = $this->call($requestObject);

        $responseObject = new \XtractaApi\Api\Database\Data\CreateResponse($response);

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getDataObject();
        }

        // Check for errors
        return false;
    }

    public function updateData($apiKey, $databaseId, $data)
    {
        $requestObject = new \XtractaApi\Api\Database\Data\UpdateRequest($apiKey, $databaseId, $data);

        $responseObject = new \XtractaApi\Api\Database\Data\UpdateResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK || $responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_ACCEPTED) {
            return $responseObject->getDataObject();
        }

        // Check for errors
        return false;
    }

    public function deleteRow($apiKey, $databaseId, $rowId)
    {
        $requestObject = new \XtractaApi\Api\Database\Data\DeleteRequest($apiKey, $databaseId, $rowId);

        $responseObject = new \XtractaApi\Api\Database\Data\DeleteResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getDataObject();
        }

        // Check for errors
        return false;
    }

    public function getWorkflows($apiKey, $groupId)
    {
        $requestObject = new \XtractaApi\Api\Workflow\ListRequest($apiKey, $groupId);

        $responseObject = new \XtractaApi\Api\Workflow\ListResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getResponse();
        }

        // Check for errors
        return false;
    }

    public function getWorkflow($apiKey, $workflowId)
    {
        $requestObject = new \XtractaApi\Api\Workflow\GetRequest($apiKey, $workflowId);

        $responseObject = new \XtractaApi\Api\Workflow\GetResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getResponse();
        }

        // Check for errors
        return false;
    }

    public function getDocuments($apiKey, $workflowId, $status = null, $apiStatus = 'active', $detailed = false)
    {
        $requestObject = new \XtractaApi\Api\Document\ListRequest($apiKey, $workflowId, $status, $apiStatus, $detailed);

        try {
            $response = $this->call($requestObject);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == \Illuminate\Http\Response::HTTP_NOT_FOUND) {
                return new Documents();
            }
        }

        $responseObject = new \XtractaApi\Api\Document\ListResponse($response);

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getDocumentsObject();
        }

        return false;
    }

    public function getDocumentUserInterface($apiKey, $documentId, $callbackUrl = '', $expires = 600, $afterApiDownloadStatus = null)
    {
        $requestObject = new \XtractaApi\Api\Document\UserInterface\GetRequest($apiKey, $documentId, $callbackUrl, $expires, $afterApiDownloadStatus);

        try {
            $response = $this->call($requestObject);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == \Illuminate\Http\Response::HTTP_NOT_FOUND) {
                return false;
            }
            if ($e->getResponse()->getStatusCode() == \Illuminate\Http\Response::HTTP_CONFLICT) {
                return false;
            }
        }

        $responseObject = new \XtractaApi\Api\Document\UserInterface\GetResponse($response);

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return $responseObject->getUserInterfaceObject();
        }

        // Check for errors
        return false;
    }

    public function updateDocument($apiKey, $documentId, $status = null, $apiStatus = null, $reason = null, $freeForm = null)
    {
        $requestObject = new \XtractaApi\Api\Document\UpdateRequest($apiKey, $documentId, $status, $apiStatus, $reason, $freeForm);

        $responseObject = new \XtractaApi\Api\Document\UpdateResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return true;
        }

        return false;
    }

    public function deleteGroup($apiKey, $groupId)
    {
        $requestObject = new \XtractaApi\Api\Group\DeleteRequest($apiKey, $groupId);

        $responseObject = new \XtractaApi\Api\Group\DeleteResponse($this->call($requestObject));

        if ($responseObject->getStatusCode() == \Illuminate\Http\Response::HTTP_OK) {
            return true;
        }

        return false;
    }

    /**
     * Executes the request
     *
     * @param AbstractRequest
     * @return mixed
     */
    public function call(AbstractRequest $requestObject)
    {
        $client = $this->getClient();

        $response = $client->request($requestObject->getMethod(), $requestObject->getUrl(), [
            'form_params' => $requestObject->getParameters(),
        ]);

        return $response;
    }
} // End of API class