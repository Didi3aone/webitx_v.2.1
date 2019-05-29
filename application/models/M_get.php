<?php

class M_get extends CI_Model
{
    function getRowDynamic($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $this->db->limit(1);
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getDynamic($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getDynamicArray($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->result_array();
        }
        return FALSE;
    }

    function getDynamicOrderBy($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $this->db->order_by($data['orderby'], "ASC");
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getRowDynamicDesc($data)
    {
        $this->db->select($data['select']);
        $this->db->where($data['where']);
        $this->db->order_by($data['orderby'], "DESC");
        $list = $this->db->get($data['from']);
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

	function getMasterBank()
    {
        $this->db->select('v2_master_bank.*');
        $this->db->where(['status'=>1]);
        $list = $this->db->get('v2_master_bank');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return [];
    }

    function getMasterSettingFaspay()
    {
        $this->db->select('v2_master_setting_faspay.*');
        $this->db->order_by('id', "DESC");
        $this->db->limit(1);
        $list = $this->db->get('v2_master_setting_faspay');
        return $list->row();
    }

    function getMasterSettingBooking()
    {
        $this->db->select('v2_master_setting_booking.*');
        $this->db->where(['id'=>'1']);
        $this->db->limit(1);
        $list = $this->db->get('v2_master_setting_booking');
        return $list->row();
    }

    function getMasterAirport()
    {
        $this->db->select('id, code, cityname, airportname, locale, active, countrycode');
        $list = $this->db->get('v2_master_airport');
        return $list->result();
    }

    function getMasterAirportNonGds()
    {
        $this->db->select('code, cityname, airportname');
        $this->db->where(['countrycode'=>'ID']);
        $list = $this->db->get('v2_master_airport');
        return $list->result();
    }

    function getMasterAirline()
    {
        $this->db->select('id, code, name');
        $this->db->where(array('status' => 1));
        $list = $this->db->get('v2_master_airline');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getAirlineByCode($Code)
    {
        $this->db->select('id, code, name');
        $this->db->where(array('code' => $Code));
        $list = $this->db->get('v2_master_airline');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getAirportByCode($code)
    {
        $this->db->select('id, code, cityname, airportname, locale, active, countrycode');
        $this->db->where(array('code'=> $code));
        $list = $this->db->get('v2_master_airport');
        return $list->row();
    }

    function getRsvToken()
    {
        $this->db->select('id, token , expired_at, created_at, expire');
        $this->db->order_by('id', "DESC");
        $this->db->limit(1);
        $list = $this->db->get('v2_rsv_token');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getListApi()
    {
        $this->db->select('id, name, url');
        $list = $this->db->get('v2_master_list_api');
        return $list->result();
    }

    function getAuthApi()
    {
        $this->db->select('grant_type, client_id, client_secret, scope');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $list = $this->db->get('v2_master_auth_api');
        return $list->row();
    }

    function getMasterCountry()
    {
        $this->db->select('id, nicename');
        $list = $this->db->get('v2_master_country');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    function getCountryById($CountryId)
    {
        $this->db->select('id, nicename, country_code');
        $this->db->where(array('id'=> $CountryId));
        $list = $this->db->get('v2_master_country');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    function getBookingFormula()
    {
        $this->db->select('v2_master_setting_booking.id, v2_master_setting_booking.choosen_formula');
        $this->db->where(['id'=>1]);
        $list = $this->db->get('v2_master_setting_booking');
        if ($list->num_rows() > 0) {
            $raw_formula = $list->row()->choosen_formula;
            $formula = explode("-",$raw_formula);
            $formula = implode("", $formula);
            $formula = explode("+", $formula);
            $formula = implode("", $formula);
            $formula = explode(",", $formula);
            return $formula;
        }
        return FALSE;
    }

    function getMemberTransaction($id_member, $formula)
    {
    	$sql = "SELECT *, 
    			GROUP_CONCAT(DISTINCT Rsv.rsv_id ORDER BY Rsv.id DESC) AS id, 
    			GROUP_CONCAT(DISTINCT Rsv.time_limit ORDER BY Rsv.id DESC) AS timelimits 
    			FROM v2_reservation AS Rsv 
    			WHERE member_id=".$id_member." 
    			GROUP BY inv_id ORDER BY `datersv` DESC";
    	$rsv = $this->db->query($sql);

    	if ($rsv->num_rows() > 0) {
    		foreach ($rsv->result() as $keyRsv => $valueRsv) {
    			$payment = "SELECT SUM(amount) AS total_payment 
    					FROM v2_rsv_payment 
    					WHERE id_rsv IN(".$valueRsv->id.") AND 
    						code IN ('".implode("','",$formula)."')";   
    			// edit this to using formula, the old one is commented
                if ($payment->num_rows() > 0) {
                    foreach ($payment->result() as $keyPayment => $valuePayment) {
                        if (!empty($valueRsv->disc_id)) {
                          if (!empty($valueRsv->disc_val)) {
                            $diskon = $valueRsv->disc_val;
                            $diskonx = intval(($valuePayment->total_payment * $diskon) / 100);
                          }
                          else {
                            $diskon = $valueRsv->disc_val2;
                            $diskonx = $diskon;
                          }
                          $valuePayment->total_payment -= $diskonx;
                        }
                        $valueRsv->total_payment= $valuePayment->total_payment ? number_format($valuePayment->total_payment,2,'.',',') : 0;
                    } // --- end foreach payment --- //

                    $valueRsv->datersv = date('F d, Y', strtotime($valueRsv->datersv));
                    $timelimit_arr = explode(',',$valueRsv->timelimits);
                    $max_timelimit = $timelimit_arr[0];
                    $time1 = strtotime($timelimit_arr[0]);
                    if (count($timelimit_arr) == 2) {
                        $time2 = strtotime($timelimit_arr[1]);
                        if ($time2 > $time1) {
                            $max_timelimit = $timelimit_arr[1];
                            $time1 = $timelimit_arr[1];
                        }
                    }

                    $valueRsv->max_timelimit = $max_timelimit;

                    $expired = 0;
                    if ($now >= $time1 && $valueRsv->status == '0') {
                        $expired = 1;
                    }

                    if ($expired) {
                        $valueRsv->bookstatus = 'Expired';
                    }
                    else {
                        if ($valueRsv->status == '1') {
                            $valueRsv->bookstatus = 'Ticketed';
                        }
                        else {
                            $valueRsv->bookstatus = $arrstatus[$valueRsv->paymentstatus];
                        }
                    }
                    if ($valueRsv->bookstatus == 'Ticketed') {
                        $color_status = 'green;';
                    }
                    else if ($valueRsv->bookstatus =='Expired') {
                        $color_status = 'grey;';
                    }
                    else {
                        $color_status = 'blue;';
                    }
                    $valueRsv->color_status = $color_status;
                    $tran_history[] = $row;

                } // --- end if payment --- //
    		} // --- end foreach rsv --- //
    	} // --- end if payment --- //
    	return FALSE;
    }

    // Date: Wednesday, 16 January 2019
    function getListService()
    {
        $this->db->select('ls_id, ls_name, ls_status');
        $this->db->where(['ls_status' => 1]);
        $list = $this->db->get('v2_list_service');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    // Date: Wednesday, 16 January 2019
    function CheckPayment($OrderId, $PaymentConfirmed = null)
    {
        $this->db->select('pay_payment_status, pay_order_id');
        $this->db->where(['pay_order_id' => $OrderId]);
        if($PaymentConfirmed) {
            $this->db->where(['pay_payment_status >' => 1]);            
        }
        $this->db->order_by('pay_order_id', "DESC");
        $list = $this->db->get('v2_rsv_payment');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function RsvPayment($keyRsv, $valRsv)
    {
        $this->db->select('pay_order_id, pay_reff_id, pay_service_type');
        $this->db->where([$keyRsv => $valRsv]);
        $list = $this->db->get('v2_rsv_payment');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 16 January 2019
    function getListPaymentGateway()
    {
        $this->db->select('lpg_name, lpg_code, lpg_status');
        $this->db->where(['lpg_status' => 1]);
        $list = $this->db->get('v2_list_payment_gateway');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }
    
    // Date: Wednesday, 23 January 2019
    function getMasterStatusText()
    {
        $this->db->select('*');
        $this->db->where(['st_type' => 1]);
        $this->db->limit(1);
        $list = $this->db->get('v2_master_status_text');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function getReservation($OrderId, $RsvResponse = NULL)
    {
        $RsvResponse = $RsvResponse ? ', rsv_response' : '';
        $this->db->select('rsv_id, rsv_pnr_id, rsv_is_ticketed, rsv_time_limit' . $RsvResponse);
        $this->db->where(['rsv_order_id' => $OrderId]);
        $list = $this->db->get('v2_reservation');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function getLogFlightReservation($OrderId, $LfrResponse = NULL)
    {
        $LfrResponse = $LfrResponse ? ', lfr_response' : '';
        $this->db->select('lfr_order_id, lfr_id, lfr_model, lfr_pnr_id, lfr_request, lfr_model, lfr_created_at' . $LfrResponse);
        $this->db->where(['lfr_order_id' => $OrderId]);
        $list = $this->db->get('v2_log_flight_rsv');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function getRsvPaymentDetail($RsvId)
    {
        $this->db->select('rpd_reservation_id, rpd_amount');
        $this->db->where(['rpd_reservation_id' => $RsvId]);
        $list = $this->db->get('v2_rsv_payment_detail');
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function CheckDiscount($OrderId)
    {
        $this->db->select('disc_order_id, disc_nominal, disc_type');
        $this->db->where(['disc_order_id' => $OrderId]);
        $list = $this->db->get('v2_rsv_payment_discount');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function getPaymentGatewayData($ReffId)
    {
        $this->db->select('*');
        $this->db->where(['pg_reff_id' => $ReffId]);
        $list = $this->db->get('v2_pay_gateway_post');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function getBankById($BankId)
    {
        $this->db->select('id, name, rekening, rekening_name');
        $this->db->where(['id' => $BankId]);
        $list = $this->db->get('v2_master_bank');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function CheckStatusCallback($RequestId)
    {
        $this->db->select('cpf_request_id, cpf_flight_count, cpf_if_success');
        $this->db->where(['cpf_request_id' => $RequestId]);
        $list = $this->db->get('v2_callback_opsigo_flight');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function CheckStatusCallbackReservation($PnrId, $Type)
    {
        $this->db->select('cops_text, cops_id');
        $this->db->where([
            'cops_pnr_id'       => $PnrId,
            'cops_type'         => $Type,
            'cops_progress >'   => 99
        ]);
        $list = $this->db->get('v2_callback_opsigo');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;
    }

    // Date: Wednesday, 23 January 2019
    function CheckUseVoucher($VoucherCode)
    {
        $this->db->select('mdisc_id, mdisc_code, mdisc_stock, mdisc_type, mdisc_nominal, mdisc_start_date, mdisc_end_date');
        $this->db->where([
            'mdisc_code'            => $VoucherCode,
            'mdisc_is_publish'      => 1,
            'mdisc_status'          => 1
        ]);
        $list = $this->db->get('v2_master_discount');
        if ($list->num_rows() > 0) {
            return $list->row();
        }
        return FALSE;        
    }

}