<?php

use GuzzleHttp\Client;

class Privyid_api {


  function tesGet($url, $data)
  {

    // list($baseurl, $endpoint) = func_get_args();
    $client = new Client(['verify' => false]);

    $resp = $client->get($url, $data);

    echo $resp->getBody();
  }

  function getPrivyAPI($url, $data)
  {
    $client = new Client(['verify' => false]);
   
    try {
      $response = $client->get($url, $data);
      return $response->getBody();
    }
    catch (GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      return $response->getBody();
    }

  }

  function postPrivyAPI($url, $data)
  {
    $client = new Client(['verify' => false]);
   
    try {
      $response = $client->post($url, $data);
      return $response->getBody();
    }
    catch (GuzzleHttp\Exception\ClientException $e) {
      $response = $e->getResponse();
      return $response->getBody();
    }

  }

}