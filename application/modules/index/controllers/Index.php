<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MX_Controller {

	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->library(array('form_validation', 'general','ion_auth'));
	}

	public function index()
	{
		$this->data['is_breadcrumb'] = 'none';

		$this->data['data'] = $this->Global_model->set_model('mst_article','ma','id')->mode(array(
			'type' => 'all_data',
			'select' => 'mca.name, ma.*',
			'joined' => array(
				'mst_category_article mca' => array(
					'mca.id' => 'ma.category_id'
				)
			),
			'limit' => 2,
			'start' => 1
		));

		$this->load->view(LAYOUT_FRONTEND_HEADER, $this->data, FALSE);
		$this->load->view('index/index', $this->data, FALSE);
		$this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data, FALSE);
	}

}

/* End of file Index.php */
/* Location: ./application/modules/index/controllers/Index.php */