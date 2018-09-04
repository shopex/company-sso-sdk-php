<?php
namespace Shopex\CompanySSO;

use GuzzleHttp\Client;
use Elrond\WorkWechat\Exceptions\ResultException;

class Requester
{
    private $key = "";

    private $secret = "";

    private $client = null;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;

        $this->client = new Client();
    }

    public function rpcCall($method = "post", $url = "", $params = [], $useSecret = true)
    {
        $params['client_id'] = $this->key;
        if($useSecret)
        {
            $params['client_secret'] = $this->secret;
        }

        return $this->request($method, $url, $params);
    }


    public function request($method = "post", $url = "", $params = [])
    {
        $method = strtoupper($method);
        if($method == "GET")
        {
            $url = $url . "?" . http_build_query($params);
        }
        $res= $this->client->request($method, $url, [
            'form_params' => $params
        ]);
        $body = $res->getBody();
        $responseParams = json_decode($body, true);
        if($responseParams['status'] != 1)
            throw new ResultException($responseParams['msg'], $responseParams['status']);
        return $responseParams;
    }

}

