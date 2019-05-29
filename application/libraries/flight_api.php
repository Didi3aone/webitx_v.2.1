<?php

if (!class_exists('Curl\Curl')) {
  include('./vendor/phpcurl/ArrayUtil.php');
  include('./vendor/phpcurl/Curl.php');
  include('./vendor/phpcurl/MultiCurl.php');
  include('./vendor/phpcurl/CaseInsensitiveArray.php');
}

class flight_api {

  function generateToken($url, $dataAuth)
  {
    $curl = new Curl\Curl();

    $curl->setHeader('Content-Type', 'application/x-www-form-urlencoded' );
    $curl->setHeader('Cache-Control', 'no-cache');

    $Result = FALSE;
    $curl->post($url, $dataAuth);
    if (!$curl->error) {
        $Result = $curl->response;
    }
    $curl->close();
    return array('response'=> $Result);
  }

  function getFlightAvailability($url, $data, $token) {
    $Result = FALSE;
    $UnAuthorized = FALSE;
    $Error = FALSE;

    $curl = new Curl\Curl();
    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');

    $curl->post($url, $data);
    if (!$curl->error) {
        if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
          $UnAuthorized = TRUE;
        }
    }
    else {
      $Error = TRUE;
    }
    $Result = $curl->response;
    $curl->close();
    return array('response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'error' => $Error, 'total_time'=>$curl->totalTime);
  }

  function getFareDetail($url, $data, $token) {
    $Result = FALSE;
    $UnAuthorized = FALSE;
    $Error = FALSE;

    $curl = new Curl\Curl();
    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');
        
    $curl->post($url, $data);
    if (!$curl->error) {
        if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
          $UnAuthorized = TRUE;
        }
    }
    else {
      $Error = TRUE;
    }
    $Result = $curl->response;
    $curl->close();
    return array('response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'error' => $Error, 'total_time'=>$curl->totalTime);
  }

  function FlightReservation($url, $data, $token) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    
    $curl = new Curl\Curl();

    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');
    
    $curl->post($url, $data);
    if ($curl->error) {
      $Error = TRUE;
    }
    else {
      if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
        $UnAuthorized = TRUE;
      }
    }
    $Result = $curl->response;
    $curl->close();
    return array('error' => $Error, 'response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'status_code' => $curl->httpStatusCode);
  }

  function getReservationById($url, $data, $token) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    $curl = new Curl\Curl();

    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');
    
    $curl->get($url, $data);
    if ($curl->error) {
      $Result = $curl->response;
      $Error = TRUE;
    }
    else {
      if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
        $UnAuthorized = TRUE;
      }
      else {
        $Result = $curl->response;
      }
    }
    $curl->close();
    return array('error' => $Error, 'response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'status_code' => $curl->httpStatusCode);
  }

  function getReservationByIdController($data) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    $curl = new Curl\Curl();

    $curl->setHeader('Content-Type', 'application/json');
    $url = base_url('api/flight/getReservation');
    $curl->post($url, $data);
    if ($curl->error) {
      $Error = TRUE;
    }

    $Result = $curl->response;
    $curl->close();
    return array('error' => $Error, 'response'=>$Result);
  }

  function IssuedTicket($url, $data, $token) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    $curl = new Curl\Curl();

    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');
    
    $curl->post($url, $data);
    if ($curl->error) {
      $Result = $curl->response;
      $Error = TRUE;
    }
    else {
      if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
        $UnAuthorized = TRUE;
      }
      else {
        $Result = $curl->response;
      }
    }
    $curl->close();
    return array('error' => $Error, 'response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'status_code' => $curl->httpStatusCode);
  }

  // --- Resend Mail --- //
  function resendMail($data) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    $curl = new Curl\Curl();

    $curl->setHeader('Content-Type', 'application/json');
    $url = base_url('api/email/sendMailPayment');
    $curl->post($url, $data);
    if ($curl->error) {
      $Error = TRUE;
    }

    $Result = $curl->response;
    $curl->close();
    return array('error' => $Error, 'response'=>$Result);
  }

  function CancelReservation($url, $data, $token) {
    $Result       = FALSE;
    $UnAuthorized = FALSE;
    $Error        = FALSE;
    
    $curl = new Curl\Curl();

    $curl->setHeader('Authorization', 'Bearer '.$token);
    $curl->setHeader('Content-Type', 'application/json');
    
    $curl->post($url, $data);
    if ($curl->error) {
      $Error = TRUE;
    }
    else {
      if ($curl->response && isset($curl->response->Message) && $curl->response->Message == 'Unauthorized') {
        $UnAuthorized = TRUE;
      }
    }
    $Result = $curl->response;
    $curl->close();
    return array('error' => $Error, 'response'=>$Result, 'UnAuthorized'=> $UnAuthorized, 'status_code' => $curl->httpStatusCode);
  }
  
}

?>