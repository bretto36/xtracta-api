<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use XtractaApi\XtractaApi;

class DocumentsTest extends \PHPUnit_Framework_TestCase
{
    public function test_list_documents_returns_documents()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/documents_with_rejection.xml')),
            new Response(200, [], file_get_contents('tests/xml/documents_with_rejection.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->getDocuments('apikey', '1', null, 'active', true);

        // Check rows
        $this->assertEquals(1, count($response->documents));
    }

    public function test_list_documents_returns_documents_with_a_rejection_reason()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/documents_with_rejection.xml')),
            new Response(200, [], file_get_contents('tests/xml/documents_with_rejection.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->getDocuments('apikey', '1', null, 'active', true);

        // Check rows
        $this->assertEquals(1, count($response->documents));

        foreach ($response->documents as $document) {
            $this->assertEquals('reject', $document->status);
            $this->assertEquals(1, count($document->rejections));

            foreach ($document->rejections as $rejection) {
                $this->assertEquals('The Order Number could not be found in the list of orders', $rejection->message);
            }
        }
    }
}
