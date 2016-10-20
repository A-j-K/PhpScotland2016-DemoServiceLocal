<?php

namespace PhpScotland2016\Demo\Service\Impls;

use PhpScotland2016\Demo\Service\Interfaces\DemoServiceRequest;
use PhpScotland2016\Demo\Service\Interfaces\DemoServiceResponse;
use PhpScotland2016\Demo\Service\Interfaces\DemoServiceInterface;

class DemoServiceLocal implements DemoServiceInterface
{
	public function handleRequest(DemoServiceRequest $request) {
		$wait_for = $request->getParam("wait_for", 10);
		if(is_numeric($wait_for)) {
			$wait_for = (int)$wait_for;
			if($wait_for > 10) {
				$wait_for = 10;
			}
			
		}
		sleep($wait_for);
		$message = [
			'result' => 0,
			'wait_for' => $wait_for,
			'msg' => 'Well, I waited as asked!'
		];
		$response = new DemoServiceResponse;
		$response->setHeader("Content-Type", "application/json");
		$response->setBody(json_encode($message, JSON_HEX_QUOT|JSON_PRETTY_PRINT));
		return $response;
	}
}

