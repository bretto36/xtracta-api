<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use XtractaApi\XtractaApi;

class ProvisioningTest extends \PHPUnit_Framework_TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_provisioning_returns_successful_message()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/provisioning_success.xml')),
            //new Response(202, ['Content-Length' => 0]),
            //new RequestException("Error Communicating with Server", new Request('GET', 'test'))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->provisionUser('apikey', '1', 'customer1');

        $this->assertEquals(1234, $response->group_id);
        $this->assertEquals('Test', $response->group_name);
        $this->assertEquals('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', $response->api_key);

        // Check workflows
        $this->assertEquals(1, count($response->workflows));
        $workflow = $response->workflows[0];
        $this->assertEquals(1111, $workflow->id);
        $this->assertEquals('Accounts Payable', $workflow->name);
        $this->assertEquals('test@akl.xtracta.com', $workflow->email);
        $this->assertEquals('test:test@akl.xtracta.com', $workflow->file_transfer_url);
        $this->assertEquals(1112, $workflow->source_id);

        // Check First Database
        $this->assertEquals(1, count($response->databases));

        $database = $response->databases[0];

        $this->assertEquals(1234, $database->id);
        $this->assertEquals('Suppliers (WF 1111)', $database->name);

        // Check columns
        $this->assertEquals(2, count($database->columns));
    }
}
