<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use XtractaApi\XtractaApi;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    public function test_delete_group()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/documents_with_rejection.xml')),
        ]);

        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->deleteGroup('apikey', '1');

        $this->assertTrue($response);
    }
}
