<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	private $_view = 'about/';
    protected $data;
    protected $data_header;
    protected $data_footer;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'general','ion_auth'));
        // $this->load->helper(array('language', 'form'));
        $this->load->model('m_general');
        $this->general->saveVisitor($this, [1, 0]);
        $this->data = array();
        $this->data_header = array();
        $this->data_footer = array();
    }
	
	/**
     * [index ui article]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
	public function index()
	{
		$this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Blog';
        $this->data_header['breadcrumb_child'] = 'Event And News';

        $this->data_footer['view_js'] = array();

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'index', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
	}

}

/* End of file About.php */
/* Location: ./application/modules/about/controllers/About.php */