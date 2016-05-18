<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use XtractaApi\XtractaApi;

class UpdateDataTest extends \PHPUnit_Framework_TestCase
{
    public function test_provisioning_returns_successful_message()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/update_data_success.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $suppliers = array();

        $suppliers[1] = array(
            'Name' => 'Hello',
            'Reference' => 123,
        );

        $response = $api->updateData('apikey', '1', $suppliers);

        // Check rows
        $this->assertEquals(2, $response->rows_affected);
    }
}
