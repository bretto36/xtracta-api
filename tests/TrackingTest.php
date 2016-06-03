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
    public function test_list_response()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/workflow_tracking_response.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->getWorkflowTracking('apikey', '1');

        $this->assertEquals(3, $response->total);
        $this->assertEquals(1, $response->page);
        $this->assertEquals(20, $response->per_page);

        // Check inputs
        $this->assertEquals(3, count($response->inputs));

        $input = $response->inputs[0];

        $this->assertEquals(123456, $input->id);
        $this->assertEquals('email', $input->type);
        $this->assertEquals('2016-05-31T12:52:41+12:00', $input->received);
        $this->assertEquals('OK', $input->status);

        $this->assertEquals(3, count($input->files));

        $file = $input->files[0];

        $this->assertEquals(12345, $file->id);
        $this->assertEquals('File1.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/60/f1/aaaaa.pdf', $file->url);
        $this->assertEquals('Done', $file->status);

        $file = $input->files[1];

        $this->assertEquals(12346, $file->id);
        $this->assertEquals('File2.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/dd/ad/bbbbb.pdf', $file->url);
        $this->assertEquals('Done', $file->status);

        $file = $input->files[2];

        $this->assertEquals(12347, $file->id);
        $this->assertEquals('File3.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/a9/de/ccccc.pdf', $file->url);
        $this->assertEquals('Done', $file->status);
    }

    public function test_get_response()
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents('tests/xml/document_tracking_response.xml')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new XtractaApi(['client' => $client]);

        $response = $api->getDocumentTracking('apikey', '1');

        $this->assertEquals(12345, $response->id);
        $this->assertEquals('email', $response->type);
        $this->assertEquals('2016-05-31T12:52:41+12:00', $response->received);
        $this->assertEquals('OK', $response->status);
        $this->assertEquals('Test Person <test@test.com>', $response->from);
        $this->assertEquals('other files', $response->subject);

        $this->assertEquals(3, count($response->files));

        $file = $response->files[0];

        $this->assertEquals(1111, $file->id);
        $this->assertEquals('File1.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/60/f1/aaaaa.pdf', $file->url);
        $this->assertEquals('Done', $file->status);

        // Check activities
        $this->assertEquals(2, count($file->activities));

        $activity = $file->activities[0];

        $this->assertEquals('Processing', $activity->description);
        $this->assertEquals('System', $activity->username);
        $this->assertEquals('2016-05-31T12:52:59+12:00', $activity->date);

        $activity = $file->activities[1];

        $this->assertEquals('Awaiting rejection review', $activity->description);
        $this->assertEquals('System', $activity->username);
        $this->assertEquals('2016-05-31T12:53:49+12:00', $activity->date);
        // End Activity Check

        $file = $response->files[1];

        $this->assertEquals(1112, $file->id);
        $this->assertEquals('File2.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/dd/ad/bbbbb.pdf', $file->url);
        $this->assertEquals('Done', $file->status);

        $file = $response->files[2];

        $this->assertEquals(1113, $file->id);
        $this->assertEquals('File3.pdf', $file->name);
        $this->assertEquals('https://web1-akl.xtracta.com/datasource/1/a9/de/ccccc.pdf', $file->url);
        $this->assertEquals('Done', $file->status);
    }
}
