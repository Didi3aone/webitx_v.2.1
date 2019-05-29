<?php

class Adminpanel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 0]);
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		redirect(base_url('adminpanel/login/logout'));
    }

    public function dashboard()
    {
    	$data = [];
    	$data['HeaderBar'] = [
    		'FaName' 			=> 'fa-home',
    		'LeftMenuTitle' 	=> 'Dashboard',
    		'RightMenuTitle' 	=> [
    			['isUrl' => FALSE,'Name' => 'Dashboard'],
    		]
    	];
    	$data = $this->globalFunction($data);
        $this->load->view('adminpanel/template/dashboard', $data);
    }

	public function messages()
    {

    }

    protected function globalFunction($data)
    {
        $data['MasterGeneral']         = $this->m_get->getRowDynamic([
            'select'    => 'favicon, logo',
            'from'      => 'v2_master_landingpage',
            'where'     => [
                'id' => 1
            ]
        ]);

    	$data['ViewHead'] 			= $this->load->view('adminpanel/template/head', $data, TRUE);
    	$data['ViewPreLoader'] 		= $this->load->view('adminpanel/template/preloader', [], TRUE);
    	$data['ViewFooter'] 		= $this->load->view('adminpanel/template/footer', [], TRUE);
    	$data['ViewLeftPanel'] 		= $this->load->view('adminpanel/template/left_panel', $data, TRUE);
    	$data['ViewHeaderBar'] 		= $this->load->view('adminpanel/template/header_bar', $data['HeaderBar'], TRUE);
    	$data['ViewCopyRight'] 		= $this->load->view('adminpanel/template/copyright', [], TRUE);
    	return $data;
    }

}

?>