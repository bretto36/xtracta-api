<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use XtractaApi\XtractaApi;

class AddDataTest extends \PHPUnit_Framework_TestCase
{
    public function test_provisioning_returns_successful_message()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/add_data_success.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $suppliers = array();

        $suppliers[] = array(
            'Name' => 'Hello',
            'Reference' => 123,
        );

        $response = $api->addData('apikey', '1', $suppliers);

        // Check rows
        $this->assertEquals(1, count($response->rows));

        $row = $response->rows[0];
        $this->assertEquals(1, $row->id);
    }

    public function test_provisioning_returns_successful_message_when_adding_multiple_rows()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/add_data_success_multiple_rows.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $suppliers = array();

        $suppliers[] = array(
            'Name' => 'Hello',
            'Reference' => 123,
        );

        $suppliers[] = array(
            'Name' => 'Hello 2',
            'Reference' => 124,
        );

        $response = $api->addData('apikey', '1', $suppliers);

        // Check rows
        $this->assertEquals(2, count($response->rows));

        $row = $response->rows[0];
        $this->assertEquals(1, $row->id);

        $row = $response->rows[1];
        $this->assertEquals(2, $row->id);
    }
}
