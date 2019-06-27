<?php 
    class Article_model extends CI_Model
    {
        private $_table = "mst_article";
        private $_alias = "ma";
        private $_pk_field = "id";
        
        public function get_all_data( $params = array() )
        {
            
            if( isset($params['limit']) && isset($params['offset']) )
            {
                $this->db->limit($params['limit'], ($params['offset'] == 1) ? 0 : $params['offset']);
            }

            if( isset($params['seo_url']) && isset($params['seo_url']) )
            {
                $this->db->where('seo_url', $params['seo_url']);
            }

            $this->db->select("ma.*, mca.name");
            $this->db->from($this->_table. " ".$this->_alias);
            $this->db->join('mst_category_article mca', 'ma.category_id = mca.id');
            $result = $this->db->get();
            if( isset($params['seo_url']) && $params['seo_url'] != '' )
            {
                return $result->row_array();
            } else {
                // print_r($params);
                return $result->result_array();
            }
        }
        
        public function count_all_data()
        {
            $this->db->select("count($this->_pk_field) as total");
            return $this->db->get($this->_table)->row()->total;   
        }
    }
?>