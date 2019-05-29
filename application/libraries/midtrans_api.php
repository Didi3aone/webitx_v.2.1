<?php

if (!class_exists('Curl\Curl')) {
    include('./vendor/phpcurl/ArrayUtil.php');
	include('./vendor/phpcurl/Curl.php');
	include('./vendor/phpcurl/MultiCurl.php');
	include('./vendor/phpcurl/CaseInsensitiveArray.php');
}


class midtrans_api {

	function getStatus($url, $data)
	{
		$Response = false;
		$Channels = [];

	    $curl = new Curl\Curl();
		$curl->setHeader('Content-Type', 'application/json');

		$curl->post($url, $data);
		if ($curl->error) {
	    	// do nothing
	    	$Response = $curl->response;
		}
		else if ($Response = $curl->response) {
			$resp_fp = json_decode($curl->response, true);
			if (isset($resp_fp['payment_channel']) && !empty($resp_fp['payment_channel'])) {
	        	$Channels = $resp_fp['payment_channel'];
			}
		}
    	$curl->close();
		return ['response'=>$Response, 'status_code' => $curl->httpStatusCode, 'channel' => $Channels];
	}

}