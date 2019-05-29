<?php

class Crud extends CI_Controller
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
    
    function editItinerary()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $DataItinerary = $InputData['data'];
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $DataItinerary];
        $this->load->model('m_update');

        $text = [
            'passenger_detail' => [
                'text' => $this->general->filtering_datas($DataItinerary['Text']['passenger_detail']['text']),
                'color' => $this->general->filtering_datas($DataItinerary['Text']['passenger_detail']['color'])
            ],
            'footer_title' => [
                'text' => $this->general->filtering_datas($DataItinerary['Text']['footer_title']['text']),
                'color' => $this->general->filtering_datas($DataItinerary['Text']['footer_title']['color'])
            ],
            'footer_contact' => [
                'text' => $this->general->filtering_datas($DataItinerary['Text']['footer_contact']['text']),
                'color' => $this->general->filtering_datas($DataItinerary['Text']['footer_contact']['color'])
            ]
        ];

        $ItineraryData = [
            'data'  => [
                'text'          => json_encode($text)
            ],
            'table' => 'v2_master_itinerary',
            'where'     => ['id' => 1],
        ];
        if($this->session->flashdata('LogoFooter')){
            $ItineraryData['data']['image_footer'] = $this->session->flashdata('LogoFooter');
        }
        if (!isset($DataItinerary['UseFooterLogo'])) {
            $ItineraryData['data']['image_footer'] = '';
        }
        $this->m_update->updateDynamic($ItineraryData);
        $Return['Data'] = $ItineraryData;
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }
    
    function editAirline()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $AirlineData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $AirlineData];
        $this->load->model('m_update');

        $Airlines = [];
        foreach ($AirlineData as $key => $value) {
            $dataAirline = [
                'data'  => ['status'      => $value['AirlineStatus'] ? 1 : 0],
                'table'     => 'v2_master_airline',
                'where'     => ['id' => $value['AirlineId']],
            ];
            $Airlines[] = $dataAirline;
            $this->m_update->updateDynamic($dataAirline);
        }
        
        $Return['Data'] = $Airlines;
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

    function editSettingAirport()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $SettingAirportData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $SettingAirportData];
        $this->load->model('m_update');

        $dataSettingAirport = [
            'data'      => ['msa_type' => $SettingAirportData['msa_type'] ],
            'table'     => 'v2_master_setting_airport',
            'where'     => ['msa_id' => 1],
        ];
        $this->m_update->updateDynamic($dataSettingAirport);
        $Return['Data'] = $dataSettingAirport;
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

    // -------------------------------------------------- BANK -------------------------------------------------- //
    function editBank()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $BankData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $BankData];
        $this->load->model('m_update');
        $dataBank = [
            'data'  => [
                'rekening'      => $BankData['RekeningNo'],
                'rekening_name' => $BankData['RekeningName'],
                'name'          => $BankData['BankName']
            ],
            'table' => 'v2_master_bank',
            'where'     => ['id' => $BankData['BankId']],
        ];
        if($this->session->flashdata('BankImage')){
            $dataBank['data']['imgor'] = $this->session->flashdata('BankImage');
        }
        $this->m_update->updateDynamic($dataBank);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

    function addBank()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $BankData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $BankData];
        $dataBank = [
            'data'  => [
                'name'              => $BankData['BankName'],
                'rekening'          => $BankData['RekeningNo'],
                'rekening_name'     => $BankData['RekeningName'],
                'status'            => 1,
                'createddate'       => date("Y-m-d H:i:s")
            ],
            'table' => 'v2_master_bank'
        ];
        if($this->session->flashdata('BankImage')){
            $dataBank['data']['imgor'] = $this->session->flashdata('BankImage');
        }
        $this->load->model('m_insert');
        $this->m_insert->insertDynamic($dataBank);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

    function deleteBank() 
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $BankId = $this->general->filtering_datas($InputData['BankId']);
        $Return = ['StatusResponse'=>0, 'Message'=>''];
        $this->load->model('m_update');
        $this->m_update->updateDynamic([
            'data'  => [
                'status' => 2,
            ],
            'table' => 'v2_master_bank',
            'where'     => ['id' => $BankId],
        ]);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }
    // -------------------------------------------------- END BANK -------------------------------------------------- //

    // -------------------------------------------------- DISCOUNT -------------------------------------------------- //
    function deleteDiscount() 
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $DiscountId = $this->general->filtering_datas($InputData['DiscountId']);
        $Return = ['StatusResponse'=>0, 'Message'=>'Voucher Code Is Exist'];
        $this->load->model('m_update');
        $this->m_update->updateDynamic([
            'data'  => [
                'mdisc_status' => 0,
            ],
            'table' => 'v2_master_discount',
            'where'     => ['mdisc_id' => $DiscountId],
        ]);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

    function editDiscount()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $DiscountData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'Voucher Code Is Exist', 'Data'=> $DiscountData];

        // Check Parameter
        if (!$DiscountData['VoucherCode'] || !$DiscountData['DiscountType'] || !$DiscountData['StartDate'] ||
            !$DiscountData['EndDate'] || !$DiscountData['StartTime'] || !$DiscountData['EndTime'] || 
            !isset($DiscountData['IsPublish']) || 
            ($DiscountData['DiscountType'] == 1 && !isset($DiscountData['Nominal'])) || 
            ($DiscountData['DiscountType'] == 2 && !isset($DiscountData['Percent']))) {
            $Return['Message'] = "Invalid Paramters";
        }
        else if ($DiscountData['Quantity'] < $DiscountData['Stock']) {
            $Return['Message'] = "Stock cant less then quantity";
        }
        else {
            $StartDateSplit = explode('/', $DiscountData['StartDate']);
            $EndDateSplit = explode('/', $DiscountData['EndDate']);
            $StartDate = date("Y-m-d H:i:s", strtotime($StartDateSplit[2].'-'.$StartDateSplit[0].'-'.$StartDateSplit[1].' '.$DiscountData['StartTime']));
            $EndDate = date("Y-m-d H:i:s", strtotime($EndDateSplit[2].'-'.$EndDateSplit[0].'-'.$EndDateSplit[1].' '.$DiscountData['EndTime']));
            $Return['StartDate'] = $StartDate;
            $Return['EndDate'] = $EndDate;

            if ($DiscountData['DiscountType'] == 1) {
                $Nominal = $DiscountData['Nominal'];
            }
            else if ($DiscountData['DiscountType'] == 2) {
                $Nominal = $DiscountData['Percent'];
            }

            if (strtotime($StartDate) > strtotime($EndDate)) {
                $Return['Message'] = "End Date Cannot Less Then Start Time";
            }
            else {  
                $this->load->model('m_update');
                $this->m_update->updateDynamic([
                    'data'  => [
                        'mdisc_type'            => $DiscountData['DiscountType'],
                        'mdisc_nominal'         => $Nominal,
                        'mdisc_start_date'      => $StartDate,
                        'mdisc_end_date'        => $EndDate,
                        'mdisc_status'          => 1,
                        'mdisc_name'            => '',
                        'mdisc_is_publish'      => $DiscountData['IsPublish'] ? 1 : 0,
                        'mdisc_stock'           => $DiscountData['Stock'],
                        'mdisc_description'     => '',
                        'mdisc_created_at'      => date("Y-m-d H:i:s")
                    ],
                    'table' => 'v2_master_discount',
                    'where'     => ['mdisc_id' => $DiscountData['DiscountId']],
                ]);
                $Return['StatusResponse'] = 1;
            }
        }
        echo json_encode($Return);
    }

    function addDiscount()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $DiscountData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'Voucher Code Is Exist', 'Data'=> $DiscountData];

        // Check Parameter
        if (!$DiscountData['VoucherCode'] || !$DiscountData['DiscountType'] || !$DiscountData['StartDate'] ||
            !$DiscountData['EndDate'] || !$DiscountData['StartTime'] || !$DiscountData['EndTime'] || 
            ($DiscountData['DiscountType'] == 1 && !isset($DiscountData['Nominal'])) || 
            ($DiscountData['DiscountType'] == 2 && !isset($DiscountData['Percent']))) {
            $Return['Message'] = "Invalid Paramters";
        }
        else {
            $StartDateSplit = explode('/', $DiscountData['StartDate']);
            $EndDateSplit = explode('/', $DiscountData['EndDate']);
            $StartDate = date("Y-m-d H:i:s", strtotime($StartDateSplit[2].'-'.$StartDateSplit[0].'-'.$StartDateSplit[1].' '.$DiscountData['StartTime']));
            $EndDate = date("Y-m-d H:i:s", strtotime($EndDateSplit[2].'-'.$EndDateSplit[0].'-'.$EndDateSplit[1].' '.$DiscountData['EndTime']));
            $Return['StartDate'] = $StartDate;
            $Return['EndDate'] = $EndDate;

            if ($DiscountData['DiscountType'] == 1) {
                $Nominal = $DiscountData['Nominal'];
            }
            else if ($DiscountData['DiscountType'] == 2) {
                $Nominal = $DiscountData['Percent'];
            }

            if (strtotime($StartDate) > strtotime($EndDate)) {
                $Return['Message'] = "End Date Cannot Less Then Start Time";
            }
            else {
                if(!$CheckVoucerCode = $this->m_get->getRowDynamic([
                    'select'    => 'mdisc_id',
                    'from'      => 'v2_master_discount',
                    'where'     => ['mdisc_code' => $DiscountData['VoucherCode']]
                ])) {
                    
                    $this->load->model('m_insert');
                    $this->m_insert->insertDynamic([
                        'data'  => [
                            'mdisc_type'            => $DiscountData['DiscountType'],
                            'mdisc_nominal'         => $Nominal,
                            'mdisc_start_date'      => $StartDate,
                            'mdisc_end_date'        => $EndDate,
                            'mdisc_code'            => $DiscountData['VoucherCode'],
                            'mdisc_status'          => 1,
                            'mdisc_name'            => '',
                            'mdisc_is_publish'      => isset($DiscountData['IsPublish']) ? 1 : 0, 
                            'mdisc_qty'             => $DiscountData['Quantity'],
                            'mdisc_stock'           => $DiscountData['Quantity'],
                            'mdisc_description'     => '',
                            'mdisc_created_at'      => date("Y-m-d H:i:s")
                        ],
                        'table' => 'v2_master_discount'
                    ]);
                    $Return['StatusResponse'] = 1;
                }
            }
        }
        echo json_encode($Return);
    }
    // -------------------------------------------------- END DISCOUNT -------------------------------------------------- //


    public function editContactUs() {
        $InputData = (Array) json_decode(file_get_contents('php://input'),true);
        $InputData = $InputData['data'];
        $Return = ['StatusResponse'=>0, 'Message'=>''];
        $this->load->model('m_update');
        $ContactUsData = [
            'data'  => [
                'company_name'                      => $this->general->filtering_datas($InputData['CompanyName']),
                'company_address'                   => $InputData['CompanyAddress'],
                'copyright'                         => $this->general->filtering_datas($InputData['CopyRight']),
                'contactus_contact_center'          => json_encode($InputData['ContactCenter']),
                'contactus_tour_inquiries'          => json_encode($InputData['ContactCenter2']),
                'contactus_complain_compliment'     => json_encode($InputData['ContactCenter3'])
            ],
            'table' => 'v2_master_landingpage',
            'where'     => ['id' => 1],
        ];
        $this->m_update->updateDynamic($ContactUsData);
        $Return['StatusResponse'] = 1;
        $Return['data'] = $ContactUsData;
        echo json_encode($Return);
    }
}