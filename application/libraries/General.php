<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General {

	public function __construct()
    {
    	$this->CI =& get_instance();
        $this->CI->load->helper('security');
    }

	function getOrderId($FlightType, $Id) {
		return $FlightType . date('Ymd') . $Id . date('His');
	}

	function getIpAddress()
	{
		$ClientIP = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['SERVER_ADDR'];
		if (strpos($ClientIP, ':')) {
			$ClientIP = explode(':', $ClientIP)[0];
		}
		return $ClientIP;
	}

	function saveVisitor($t, $type){
		

		$Visitor = [
			'lv_ip_address' => $this->getIpAddress(),
			'lv_user_agent'	=> $this->getUserAgent(),
			'lv_created_at'	=> date('Y-m-d H:i:s'),
			'lv_page'		=> base_url(uri_string()),
			'lv_type'		=> $type[0],
			'lv_is_ajax'	=> $type[1]
		];
		$t->db->insert('v2_log_visitor', $Visitor );
	}

	function getUserAgent()
	{
		$CI =& get_instance();
        $CI->load->library('user_agent');

		if ($CI->agent->is_browser())
		{
			$agent = $CI->agent->browser().' '.$CI->agent->version();
		}
		elseif ($CI->agent->is_robot())
		{
			$agent = $CI->agent->robot();
		}
		elseif ($CI->agent->is_mobile())
		{
			$agent = $CI->agent->mobile();
		}
		else
		{
			$agent = 'Unidentified User Agent';
		}
		return $agent.', '.$CI->agent->platform();
	}

	function getTotalPayment($Payments, $Formula)
	{
		$Payment = [];
		$TotalPrice = 0;
		foreach ($Payments as $key => $value) {
			if (in_array($value->Code, $Formula)) {
				$Payment[] = $value;
				$TotalPrice+= $value->ForeignAmount;
			}
		}
		return ['Payment' => $Payment, 'TotalPrice' => $TotalPrice];
	}

	function GetAirlineCode()
	{
		$MasterAirline = '[
		{"code":"2","name":"Lion"},
		{"code":"3","name":"Sriwijaya"},
		{"code":"4","name":"Citilink"},
		{"code":"5","name":"AirAsia"},
		{"code":"6","name":"Sabre"},
		{"code":"7","name":"Garuda"},
		{"code":"8","name":"Jetstar"},
		{"code":"11","name":"Kalstar"},
		{"code":"16","name":"Cebu"},
		{"code":"17","name":"Scoot"},
		{"code":"18","name":"Malindo"}]';
		return json_decode($MasterAirline);
	}

	function GUID()
	{
	    if (function_exists('com_create_guid') === true)
	    {
	        return trim(com_create_guid(), '{}');
	    }

	    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	function filtering_datas($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
						if (is_array($value2)) {
							foreach ($value2 as $key3 => $value3) {
								$data[$key][$key2][$key3] = $this->filtering_data($value2);
							}
						}
						else {
							$data[$key][$key2] = $this->filtering_data($value2);
						}
					}
				}
				else {
					$data[$key] = $this->filtering_data($value);
				}
			}
		}
		else {
			$data = $this->filtering_data($data);
		}
		return $data;
	}

	function filtering_data($data)
	{
		$data = html_escape($data);
		$data = $this->CI->security->xss_clean($data);
		return $data;
	}

	function filtering_image($img)
	{

	}
}

?>