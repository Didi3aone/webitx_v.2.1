<?php

class Pages extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 0]);
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		redirect(base_url('adminpanel/login/logout'));
        $this->load->model('manages/m_manages');
    }

    function index(){
    	$data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'List Page',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Page', 'Url' => 'pages'],
                ['isUrl' => FALSE,'Name' => 'List Page'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['List'] = $this->m_manages->getListPages();
        // echo "<pre>";
        // print_r($data['List']);
        // die();
        $this->load->view('adminpanel/pages/all', $data);
    }

    public function detailPage($PageId) {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Edit Page',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Page', 'Url' => 'pages/edit'],
                ['isUrl' => FALSE,'Name' => 'Edit Page'],
            ]
        ];
        $data = $this->globalFunction($data);

        $data['PageData']         = $this->m_manages->getPageById($PageId);
        if (!$data['PageData']) {
            die('No Page Data');
        }
        $data['PageData']['IsPublish'] = $data['PageData']['PageStatus'] == 0 ? true : false;

        $this->load->view('adminpanel/pages/edit', $data);
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