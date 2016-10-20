<?php

require 'vendor/autoload.php';

use PhpScotland2016\Demo\Service\Interfaces\DemoServiceRequest;
use PhpScotland2016\Demo\Service\Interfaces\DemoServiceResponse;

use PhpScotland2016\Demo\Service\Impls\DemoServiceLocal;

class DemoServiceLocalTest extends PHPUnit_Framework_TestCase
{
	public function testHandleRequest() {
		$request = new DemoServiceRequest; 
		$request->setParam("wait_for", "1");
		$ut = new DemoServiceLocal;
		$response = $ut->handleRequest($request);
		$this->assertSame($response->getHeader("Content-Type"), "application/json");
		$body = $response->getBody();
		$this->assertTrue(is_string($body));
		$this->assertTrue(strlen($body) > 0);
		$this->assertStringStartsWith("{", $body, "Not valid json?");
		$this->assertStringEndsWith("}", $body, "Not valid json?");
		$arr = json_decode($body, true);
		$this->assertTrue(is_array($arr), "Failed to decode json");
		$this->assertContains("result", $arr);
		$this->assertSame($arr["result"], 0); // expect int not string
		$this->assertContains("wait_for", $arr);
		$this->assertSame($arr["wait_for"], 1); // expect int not string
	}
}

