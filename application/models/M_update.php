<?php

class m_update extends CI_Model
{

    function updateDynamic($data)
    {
        $this->db->where($data['where']);
        $this->db->update($data['table'],
            $data['data']
        );

        return TRUE;

    }

	function updateRsvToken($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('v2_rsv_token',
            [
            	'token' 		=> $data['token'],
            	'created_at' 	=> $data['created_at'],
            	'expired_at'	=> $data['expired_at'],
            	'expire'		=> $data['expire']
        	]
        );
    }

    // TRUNCATE TABLE v2_callback_opsigo;
    // TRUNCATE TABLE v2_callback_opsigo_flight;
    // TRUNCATE TABLE v2_log_flight_availability;
    // TRUNCATE TABLE v2_log_flight_rsv;
    // TRUNCATE TABLE v2_log_visitor;
    // TRUNCATE TABLE v2_master_discount;
    // TRUNCATE TABLE v2_master_setting_faspay;
    // TRUNCATE TABLE v2_pay_gateway_post;
    // TRUNCATE TABLE v2_reservation;
    // TRUNCATE TABLE v2_rsv_payment;
    // TRUNCATE TABLE v2_rsv_payment_detail;
    // TRUNCATE TABLE v2_rsv_payment_discount;
    // TRUNCATE TABLE v2_rsv_token;

    public function CheckExpiredDiscount()
    {
        // update expired discount status
        $qDiscount = "
        SELECT Rsv.rsv_id, Rsv.rsv_order_id, Rsv.rsv_pnr_id, MasterDiscount.`mdisc_id`, MasterDiscount.`mdisc_stock`
        FROM v2_reservation AS Rsv
        INNER JOIN v2_rsv_payment_discount AS RsvPaymentDiscount ON Rsv.`rsv_order_id` = RsvPaymentDiscount.`disc_order_id`
        INNER JOIN v2_master_discount AS MasterDiscount ON RsvPaymentDiscount.`disc_mdisc_id` = MasterDiscount.`mdisc_id`
        WHERE Rsv.rsv_time_limit < NOW() AND Rsv.rsv_is_ticketed != 1 AND Rsv.rsv_is_canceled != 1";
        $listD = $this->db->query($qDiscount);
        if ($listD->num_rows() > 0) {
            foreach ($listD->result() as $key => $value) {
                $this->m_update->updateDynamic([
                    'where'     => [ 'rsv_id'   => $value->rsv_id ],
                    'table'     => 'v2_reservation',
                    'data'      => [
                        'rsv_is_canceled' => 1
                    ]
                ]);
                $this->m_update->updateDynamic([
                    'where'     => [ 'mdisc_id'     => $value->mdisc_id ],
                    'table'     => 'v2_master_discount',
                    'data'      => [
                        'mdisc_stock' => $value->mdisc_stock+1
                    ]
                ]);
            }
        }
    }

}