<?php
namespace Neteller;

trait LookupByIdTrait
{
	public function lookupById($apiKey, $apiUrl){
		$request = new Request($apiKey);
		$response = $request->makeRequest("GET", $apiUrl . $this->route . $this->id, null);
		$this->updateSelfData($response['body']);
    }
}