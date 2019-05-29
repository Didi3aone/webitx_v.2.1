<?php

class Ajax extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 1]);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		die();
    }

    function uploadImageCoverPage()
    {
    	$config['upload_path']          = './assets/images/page/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            = uniqid();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {
            $data = $this->upload->data();
            $this->session->set_flashdata('uploadImageCoverPage', $data['file_name']);
        }
    }
    
    function uploadItineraryFooter()
    {
        $config['upload_path']          = './assets/images/itinerary/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            = uniqid();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {
            $data = $this->upload->data();
            $this->session->set_flashdata('LogoFooter', $data['file_name']);
        }
    }

    function uploadImageBank()
    {
        $config['upload_path']          = './assets/images/bank/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            = uniqid();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {
            $data = $this->upload->data();
            $this->session->set_flashdata('BankImage', $data['file_name']);
        }
    }

    function uploadImageSettingGeneral()
    {
    	$dataFavicon = $dataLogo = $dataBackgroundImage = [];
    	$configFavicon['upload_path']          	= './assets/images/favicon/';
        $configFavicon['allowed_types']        	= 'jpg|png|jpeg|ico|icon';
        $configFavicon['file_name']				= uniqid();
        $this->load->library('upload', $configFavicon);
        if ($this->upload->do_upload('favicon'))
        {
            $dataFavicon = $this->upload->data();
            $this->session->set_flashdata('FaviconImage', $dataFavicon['file_name']);
        }

        unset($this->upload);
        $configLogo['upload_path']          	= './assets/images/logo/';
        $configLogo['allowed_types']        	= 'jpg|png|jpeg';
        $configLogo['file_name']				= uniqid();
        $this->load->library('upload', $configLogo);
        if ($this->upload->do_upload('logo'))
        {
            $dataLogo = $this->upload->data();
            $this->session->set_flashdata('LogoImage', $dataLogo['file_name']);
        }

        unset($this->upload);
        $configBackgroundImage['upload_path']              = './assets/images/background/';
        $configBackgroundImage['allowed_types']            = 'jpg|png|jpeg';
        $configBackgroundImage['file_name']                = uniqid();
        $this->load->library('upload', $configBackgroundImage);
        if ($this->upload->do_upload('backgroundImage'))
        {
            $dataBackgroundImage = $this->upload->data();
            $this->session->set_flashdata('BackgroundImage', $dataBackgroundImage['file_name']);
        }

        echo json_encode(['favicon'=>$dataFavicon, 'logo'=>$dataLogo, 'backgroundImage'=>$dataBackgroundImage]);
    }

    function makePaymentValid() {
    	$InputData = json_decode(file_get_contents('php://input'), true);
    	$OrderId = $InputData['OrderId'];
    	$Return = ['StatusResponse'=>0, 'Message'=>'No Order Id Found'];

    	if ($OrderId){
    		$Payment = $this->m_get->getRowDynamic([
	            'select'    => 'pay_id',
	            'from'      => 'v2_rsv_payment',
	            'where'     => ['pay_order_id'=>$OrderId, 'pay_type'=>1, 'pay_status'=>1]
	        ]);

	    	if ($Payment) {
	    		$this->load->model('m_update');
		    	$this->m_update->updateDynamic([
		        	'where'		=> ['pay_id' => $Payment->pay_id],
		        	'table' 	=> 'v2_rsv_payment',
		        	'data'		=> ['pay_payment_status'=>3]
		        ]);
		        $Return['PayId'] = $Payment->pay_id;
		        $Return['StatusResponse'] = 1;
	    	}
	    	else {
	    		$Return['Message'] = 'No Payment Found';
	    	}
    	}
    	$Return['OrderId'] = $OrderId;
    	echo json_encode($Return);
    }

    function makePaymentInValid() {
    	$InputData = json_decode(file_get_contents('php://input'), true);
    	$OrderId = $InputData['OrderId'];
    	$Return = ['StatusResponse'=>0, 'Message'=>'No Order Id Found'];

    	if ($OrderId){
    		$Payment = $this->m_get->getRowDynamic([
	            'select'    => 'pay_id',
	            'from'      => 'v2_rsv_payment',
	            'where'     => ['pay_order_id'=>$OrderId, 'pay_type'=>1, 'pay_status'=>1]
	        ]);

	    	if ($Payment) {
	    		$this->load->model('m_update');
		    	$this->m_update->updateDynamic([
		        	'where'		=> ['pay_id' => $Payment->pay_id],
		        	'table' 	=> 'v2_rsv_payment',
		        	'data'		=> ['pay_payment_status'=>2]
		        ]);
		        $Return['PayId'] = $Payment->pay_id;
		        $Return['StatusResponse'] = 1;
	    	}
	    	else {
	    		$Return['Message'] = 'No Payment Found';
	    	}
    	}
    	$Return['OrderId'] = $OrderId;
    	echo json_encode($Return);
    }

}