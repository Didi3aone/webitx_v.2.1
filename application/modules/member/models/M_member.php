<?php

class M_member extends CI_Model
{
	function updateRsv($id, $data)
    {
    	$this->db->where('inv_id', $id);
		$this->db->update('rsv', $data);
    }

    function insertRsvConfirmation($data)
    {
    	$this->db->insert('rsv_conf', $data);
    }

    function getListTransactions($MemberId)
    {

        $q = "  SELECT 
                LogRsv.lfr_order_id AS OrderId,
                LogRsv.lfr_member_id AS MemberId,
                LogRsv.lfr_request AS LfrRequest,
                Rsv.rsv_id AS RsvId,
                Rsv.rsv_is_read AS IsRead,
                Rsv.rsv_status_payment AS RsvStatusPayment,
                Rsv.rsv_response AS RsvResponse,
                Rsv.rsv_time_limit AS RsvTimeLimit,
                (SELECT COUNT(rsv_id) FROM v2_reservation WHERE rsv_order_id= Rsv.rsv_order_id) AS OrderCount,
                RsvPayment.pay_bank_name AS BankName,
                RsvPayment.pay_total_pay AS TotalPrice,
                RsvPayment.pay_is_read AS PayIsRead,
                RsvPayment.pay_payment_status AS PaymentStatusId,
                CASE
                    -- WHEN (
                    --     RsvPayment.pay_payment_status = 4 OR 
                    --     Rsv.rsv_time_limit IS NULL OR
                    --     Rsv.rsv_time_limit < NOW()
                    --     )
                    --     THEN 'Expired'
                    WHEN (RsvPayment.pay_payment_status = 1 OR RsvPayment.pay_payment_status IS NULL)
                        THEN 'Waiting Payment' 
                    WHEN (RsvPayment.pay_payment_status = 2) 
                        THEN 'Waiting Validation'
                    WHEN (RsvPayment.pay_payment_status = 3) 
                        THEN 'Payment Complete' 
                    ELSE '' 
                END AS PaymentStatus,
                CASE
                    WHEN (RsvPayment.pay_type = 1) 
                        THEN 'Bank Transfer' 
                    WHEN (RsvPayment.pay_type = 2) 
                        THEN 'Debit'
                    WHEN (RsvPayment.pay_type = 3) 
                        THEN 'Credit Card' 
                    ELSE '' 
                END AS PaymentType
                FROM v2_log_flight_rsv AS LogRsv
                INNER JOIN v2_reservation AS Rsv ON Rsv.rsv_order_id=LogRsv.lfr_order_id
                LEFT JOIN v2_rsv_payment AS RsvPayment ON Rsv.rsv_order_id=RsvPayment.pay_order_id
                -- WHERE RsvPayment.pay_total_pay > 0
                WHERE LogRsv.lfr_member_id = $MemberId
                GROUP BY LogRsv.lfr_order_id
                ORDER BY LogRsv.lfr_id DESC, Rsv.rsv_id DESC
                ";

        $list = $this->db->query($q);
        if ($list->num_rows() > 0) {
            return $list->result();
        }
        return FALSE;
    }

    public function get_mitra_info()
    {
        
    }

    /**
     * [insert]
     * @param  [mix] $table 
     * @param  [mix] $data  
     * @return [INT] auto increment    
     */
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    } 

    /**
     * [check_username]
     * @param  [mix] $username 
     * @return [INT] auto increment    
     */
    public function check_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

    public function check_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row();
    }

    public function check_nik($nik)
    {
        $this->db->where('nik', $nik);
        return $this->db->get('users')->row();
    }
}