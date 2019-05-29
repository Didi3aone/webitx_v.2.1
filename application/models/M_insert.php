<?php

class M_insert extends CI_Model
{

	function insertDynamic($data)
	{
		$this->db->insert($data['table'], $data['data']);
		return $this->db->insert_id();
	}

	function insertRsvToken($data)
    {    	
        $this->db->insert('v2_rsv_token', $data);
    }

}