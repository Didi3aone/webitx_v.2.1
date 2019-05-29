<?php

class Crud_setting extends CI_Controller
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

    
    function editGeneral()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        // $ContactUsData = $this->general->filtering_datas($InputData['data']);
        $ContactUsData = $InputData['data'];
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $ContactUsData];
        $this->load->model('m_update');
        $dataGeneral = [
            'data'  => [
                'title'                 => $ContactUsData['Title'],
                'meta_keyword'          => $ContactUsData['MetaKeyword'],
                'meta_description'      => $ContactUsData['MetaDescription'],
                'color'                 => $ContactUsData['Color'],
                'tagline'               => $ContactUsData['Tagline'],
                'use_old_website'               => $ContactUsData['UseOldWebsite']
            ],
            'table' => 'v2_master_landingpage',
            'where'     => ['id' => 1],
        ];
        if($this->session->flashdata('FaviconImage')){
            $dataGeneral['data']['favicon'] = $this->session->flashdata('FaviconImage');
        }
        if($this->session->flashdata('LogoImage')){
            $dataGeneral['data']['logo'] = $this->session->flashdata('LogoImage');
        }
        if($this->session->flashdata('BackgroundImage')){
            $dataGeneral['data']['background_image'] = $this->session->flashdata('BackgroundImage');
        }
        $this->m_update->updateDynamic($dataGeneral);
        $Return['StatusResponse'] = 1;
        $Return['Data'] = $dataGeneral;
        echo json_encode($Return);
    }

    function editEmail()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $EmailData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $EmailData];
        $this->load->model('m_update');
        $dataEmail = [
            'data'  => [
                'email_from'            => $EmailData['EmailFrom'],
                'email_from_title'      => $EmailData['EmailTitle']
            ],
            'table' => 'v2_master_setting_email',
            'where'     => [],
        ];
        $this->m_update->updateDynamic($dataEmail);
        $Return['StatusResponse'] = 1;
        $Return['Data'] = $dataEmail;
        echo json_encode($Return);
    }

    function editMidtrans()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $MidtransData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $MidtransData];
        $this->load->model('m_update');
        $PaymentMethod = [];
        foreach ($MidtransData['PaymentMethod'] as $key => $value) {
            if($value){
                $PaymentMethod[] = $key;
            }
        }      
        $ChoosenPM = implode(',', $PaymentMethod);
        $dataMidtrans = [
            'data'  => [
                'msd_merchant_id'               => $MidtransData['MerchantId'],
                'msd_client_key'                => $MidtransData['ClientKey'],
                'msd_server_key'                => $MidtransData['ServerKey'],
                'msd_notification_url'          => $MidtransData['NotificationUrl'],
                'msd_finish_url'                => $MidtransData['FinishUrl'],
                'msd_unfinish_url'              => $MidtransData['UnFinishUrl'],
                'msd_error_url'                 => $MidtransData['ErrorUrl'],
                'msd_payment_method'            => $ChoosenPM,
                'msd_is_production'             => $MidtransData['IsProduction'] ? 1 : 0,
                'msd_is_auto_payment_link'      => $MidtransData['IsAutoPaymentLink'] ? 1 : 0
            ],
            'table' => 'v2_master_setting_midtrans',
            'where'     => [],
        ];
        $this->m_update->updateDynamic($dataMidtrans);
        $Return['StatusResponse'] = 1;
        $Return['Data'] = $dataMidtrans;
        echo json_encode($Return);
    }

    function editFaspay()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $FaspayData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $FaspayData];
        $this->load->model('m_update');
        $dataFaspay = [
            'data'  => [
                'cc_merchant_id'        => $FaspayData['CCMerchantId'],
                'cc_password'           => $FaspayData['CCPassword'],
                'cc_url_inquiry'        => $FaspayData['CCUrlInquiry'],
                'deb_merchant_name'     => $FaspayData['DebMerchantName'],
                'deb_merchant_id'       => $FaspayData['DebMerchantId'],
                'deb_user_id'           => $FaspayData['DebUserId'],
                'deb_password'          => $FaspayData['DebPassword'],
                'deb_url_inquiry'       => $FaspayData['DebUrlInquiry'],
                'deb_url_status_inquiry'=> $FaspayData['DebUrlStatusInquiry'],
                'deb_url_post'          => $FaspayData['DebUrlPost']
            ],
            'table' => 'v2_master_setting_faspay',
            'where'     => ['id' => 1],
        ];
        $this->m_update->updateDynamic($dataFaspay);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }
    
    function editBooking()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $BookingData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>''];
        $this->load->model('m_update');
        $Formula = [];
        foreach ($BookingData['ChoosenFormula'] as $key => $value) {
            if($value){
                $Formula[] = $key;
            }
        }        
        $ChoosenFormula = implode(',', $Formula);
        $dataBooking = [
            'data'  => [
                'choosen_formula'=> $ChoosenFormula,
                'expired_time'   => $BookingData['ExpiredTime'],
                'email'          => $BookingData['Email'],
                'issue_ticket'   => $BookingData['IssueTicket'] == true ? 1 : false
            ],
            'table' => 'v2_master_setting_booking',
            'where'     => ['id' => 1],
        ];

        $this->m_update->updateDynamic($dataBooking);
        $Return['StatusResponse'] = 1;
        // $Return['Data'] = $dataBooking;
        // $Return['Test'] = explode(",", $ChoosenFormula);
        echo json_encode($Return);
    }

    function editOpsitoolsApi()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $InputData];

        $OpsitoolsListApi = $this->general->filtering_datas($InputData['OpsitoolsListApi']);
        $OpsitoolsAuth = $this->general->filtering_datas($InputData['OpsitoolsAuth']);

        $ListApiId['token'] = array_search('token', array_column($OpsitoolsListApi, 'ListName'));
        $ListApiId['FlightAvailability'] = array_search('FlightAvailability', array_column($OpsitoolsListApi, 'ListName'));
        $ListApiId['RsvFlight'] = array_search('RsvFlight', array_column($OpsitoolsListApi, 'ListName'));
        $ListApiId['FareDetail'] = array_search('FareDetail', array_column($OpsitoolsListApi, 'ListName'));
        $ListApiId['GetRsvById'] = array_search('GetRsvById', array_column($OpsitoolsListApi, 'ListName'));
        $ListApiId['IssueRsvFlight'] = array_search('IssueRsvFlight', array_column($OpsitoolsListApi, 'ListName'));

        
        $this->load->model('m_update');
        $dataAuth = [
            'data'  => [
                'grant_type'        => $OpsitoolsAuth['GrantType'],
                'client_id'         => $OpsitoolsAuth['ClientId'],
                'client_secret'     => $OpsitoolsAuth['ClientSecret'],
                'scope'             => $OpsitoolsAuth['Scope']
            ],
            'table' => 'v2_master_auth_api',
            'where'     => ['id' => 1],
        ];
        $this->m_update->updateDynamic($dataAuth);

        foreach ($ListApiId as $key => $value) {
           $dataListApi = [
                'data'  => [
                    'url'   => $OpsitoolsListApi[$value]['ListUrl'],
                ],
                'table' => 'v2_master_list_api',
                'where'     => ['name' => $key],
            ];
            $this->m_update->updateDynamic($dataListApi);
        }

        
        $Return['StatusResponse'] = 1;
        $Return['dataAuth'] = $dataAuth;
        echo json_encode($Return);
    }

}