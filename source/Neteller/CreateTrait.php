<?php
namespace Neteller;

trait CreateTrait
{
	public function create($apiKey, $apiUrl){
		$request = new Request($apiKey);
		$response = $request->makeRequest("POST", $apiUrl . $this->route , json_encode($this));
		$this->updateSelfData($response['body']);
    }
}