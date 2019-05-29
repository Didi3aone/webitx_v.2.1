<?php

if (!class_exists('Curl\Curl')) {
    include('./vendor/phpcurl/ArrayUtil.php');
	include('./vendor/phpcurl/Curl.php');
	include('./vendor/phpcurl/MultiCurl.php');
	include('./vendor/phpcurl/CaseInsensitiveArray.php');
}


class faspay_api {

	function getDebitChannel($url, $data)
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

	function getDebitStatus($url, $data)
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
			
		}
    	$curl->close();

		return $Response;
	}

	function PostDebit($url, $data)
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
			
		}
    	$curl->close();

		return $Response;
	}


	function getDataPostDebit($data)
	{
		$DataPost = [
			"request" => "Pembelian Tiket Pesawat Terbang",
			"merchant_id" => $data['request_debit']['merchant_id'],
			"bill_no" => $data['reservation']['order_id'],
			"bill_reff" => $data['reservation']['order_id'],
			"bill_date" => date("Y-m-d H:i:s"),
			"bill_expired" => $data['reservation']['time_limit'],
			"bill_desc" => "Pembayaran #".$data['reservation']['order_id'],
			"bill_currency" => "IDR",
			"bill_gross" => str_replace(array(',','.'),'',number_format($data['reservation']['total_price'],2,'.',',')), // handling khusus klikpay BCA
			"bill_miscfee" => "0",
			"bill_total" => str_replace(array(',','.'),'',number_format($data['reservation']['total_price'],2,'.',',')),
			"cust_no" => strlen($data['contact']['FirstName'] . ' ' . $data['contact']['LastName']),
			"cust_name" => $data['contact']['FirstName'] . ' ' . $data['contact']['LastName'],
			"payment_channel" => $data['faspay']['pg_code'],
			"pay_type" => "1",
			"bank_userid" => "",
			"msisdn" => $data['contact']['MobilePhone'],
			"email" => $data['contact']['Email'],
			"terminal" => "10",
			"billing_name" => "",
			"billing_lastname" => "",
			"billing_address" => "",
			"billing_address_city" => "",
			"billing_address_region" => "",
			"billing_address_state" => "",
			"billing_address_poscode" => "",
			"billing_msisdn" => "",
			"billing_address_country_code" => "",
			"receiver_name_for_shipping" => "",
			"shipping_lastname" => "",
			"shipping_address" => "",
			"shipping_address_city" => "",
			"shipping_address_region" => "",
			"shipping_address_state" => "",
			"shipping_address_poscode" => "",
			"shipping_msisdn" => "",
			"shipping_address_country_code" => "",
			"item" => array(
			  "product" => "Invoice No. ".$data['reservation']['order_id'],
			  "qty" => "1",
			  "amount" => str_replace(array(',','.'),'',number_format($data['reservation']['total_price'],2,'.',',')),
			  "payment_plan" => "1",
			  "merchant_id" => $data['request_debit']['merchant_id'],
			  "tenor" => "00"
			),
			"reserve1" => "",
			"reserve2" => "",
			"signature" => $data['faspay']['signature']
		];
		return $DataPost;
	}

}

?>