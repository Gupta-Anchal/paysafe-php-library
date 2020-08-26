<?php 
namespace Neteller;

use Neteller\NetellerException;

class Request{
    private $apiKey;
    private $environment;

    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }

    public function makeRequest($method, $url, $body){
        $ch	= curl_init();

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        switch (strtolower($method))
        {
            case 'post':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				if ($body != null)
                {
					curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
				}
                break;
            case 'get':
                break;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Simulator: EXTERNAL',
            'Content-type: application/json',
            'Authorization: Basic ' . $this->apiKey
        ));
        curl_setopt($ch, CURLOPT_URL, $url);

        $data			= curl_exec($ch);
        $info			= curl_getinfo($ch);
		
        $response_headers = substr($data, 0, $info['header_size']);
        $response_body = substr($data, $info['header_size']);

		curl_close($ch);
        
        $response = array
        (
            'headers'	=> $response_headers,
            'body'		=> $response_body,
            'info'		=> $info,
        );

        //var_dump($response);

        if($response['info']['http_code'] && $response['info']['http_code'] > 201 && $response['body']){

            try{
                $x = new NetellerException($response['body']); 
                $json = $response['body'];
                $a = json_decode($json, true);
                //Save detail to Variable
                $detail = $a['error']['details'][0];
                if ($a['error']['details'][1])
                $detail = $a['error']['details'][1];
                echo $detail;
                header("Location: http://localhost/netlr/paysafe-php-library/sample/error.php?detail=".$detail);
                die();

            }catch(NetellerException $e){

                
            }
            //throw new NetellerException($response['body']); 
            
        }

        return $response;
    }
}