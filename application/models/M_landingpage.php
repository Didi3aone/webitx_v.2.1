<?php

class M_landingpage extends CI_Model
{
	function getMasterLandingpage()
    {
        $this->db->select('v2_master_landingpage.*');
        $this->db->limit(1);
        $list = $this->db->get('v2_master_landingpage');
        return $list->row();
    }

    function getMasterSetting()
    {
    	$this->db->select('v2_master_setting.*');
        $title = $this->db->get('v2_master_setting');
        if ($title->num_rows() > 0) {
        	return $title->row();
        }
        return $return;
    }

    function getNavPage()
    {
    	$return = [];
    	$this->db->select('v2_master_page.*');
        $this->db->where([
        	'v2_master_page.status'=> 0,
        ]);
        $this->db->where_in('v2_master_page.type_page', ['nav', 'navmore1', 'navmore2']);
        $title = $this->db->get('v2_master_page');
        if ($title->num_rows() > 0) {
        	$return[] = $title->result();
        }
        return $return;
    }

    function getFooterPage()
    {
    	$return = [];
    	for ($i=0; $i <= 1; $i++) {
	    	// position
	    	$position = $i+1;
	        $this->db->select('v2_master_page.*');
	        $this->db->where([
	        	'v2_master_page.is_parent'=>1, 
	        	'v2_master_page.position'=>$position, 
	        	'v2_master_page.status'=>0
	        ]);
	        $this->db->order_by('v2_master_page.number', 'ASC');
	        $title = $this->db->get('v2_master_page');
	        
	        if ($title->num_rows() > 0) {
	        	$titleArr = [];
	        	foreach ($title->result() as $key => $value) {
		        	$this->db->select('v2_master_page.*');
			        $this->db->where([
			        	'v2_master_page.is_parent'=>0, 
			        	'v2_master_page.status'=>0, 
			        	'v2_master_page.parentid'=>$value->id
			        ]);
			        $this->db->order_by('v2_master_page.number', 'ASC');
			        $subTitle = $this->db->get('v2_master_page');

			        if ($subTitle->num_rows() > 0) {
			        	$titleArr[]= ['title'=> $value, 'subTitle' => $subTitle->result()];
			        }
		        }
	        	$return[] = ['position'=>($i+1), 'title' => $titleArr];
	        }
	    }
        return $return;
    }

}