<?php

class Settings extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 0]);
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		redirect(base_url('adminpanel/login/logout'));
        $this->load->model('settings/m_settings');
    }

    public function general() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'General',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/general'],
                ['isUrl' => FALSE,'Name' => 'General'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['GeneralData'] = [];
        $ContactUs = $this->m_settings->getGeneralData();
        $data['GeneralData'] = $ContactUs;

        // $data['GeneralData']->ChoosenCheckbox = [];
        // $data['GeneralData']->ListCheckbox = ["checkbox-on-blue.png", "checkbox-on.png"];
        // $ChoosenCheckbox = ["checkbox-on.png"];
        // foreach ($data['GeneralData']->ListCheckbox as $key => $value) {
        //     if (in_array($value, $ChoosenCheckbox)) {
        //         // $data['SettingBooking']->ListFormula[] = ['title'=> $value, 'status' => true];
        //         $data['GeneralData']->ChoosenCheckbox[$value] = true;
        //     }
        //     else {
        //         $data['GeneralData']->ChoosenCheckbox[$value] = false;
        //         // $data['SettingBooking']->ListFormula[] = ['title'=> $value, 'status' => false];
        //     }
        // }

        $this->load->view('adminpanel/settings/general/edit', $data);
    }

    public function booking() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Booking',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/booking'],
                ['isUrl' => FALSE,'Name' => 'Booking'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['SettingBooking'] = [];
        $SettingBooking = $this->m_settings->getSettingBooking();
        $SettingBooking->IssueTicket = $SettingBooking->IssueTicket == 1 ? true : false;
        $ChoosenFormula = explode(",", $SettingBooking->ChoosenFormula);
        $data['SettingBooking'] = $SettingBooking;
        // $data['SettingBooking']->ChoosenFormula = $ChoosenFormula;
        $data['SettingBooking']->ChoosenFormula = [];
        $ListFormula = ['TOTAL', 'NTS', 'SF'];
        $data['SettingBooking']->ListFormula = $ListFormula;
        foreach ($ListFormula as $key => $value) {
            if (in_array($value, $ChoosenFormula)) {
                // $data['SettingBooking']->ListFormula[] = ['title'=> $value, 'status' => true];
                $data['SettingBooking']->ChoosenFormula[$value] = true;
            }
            else {
                $data['SettingBooking']->ChoosenFormula[$value] = false;
                // $data['SettingBooking']->ListFormula[] = ['title'=> $value, 'status' => false];
            }
        }

        $this->load->view('adminpanel/settings/booking/edit', $data);
    }

    public function email() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Email',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/email'],
                ['isUrl' => FALSE,'Name' => 'Email'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['SettingEmail'] = [];
        $SettingEmail = $this->m_settings->getSettingEmail();
        $data['SettingEmail'] = $SettingEmail;
        $this->load->view('adminpanel/settings/email/edit', $data);
    }

    public function faspay() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Faspay',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/faspay'],
                ['isUrl' => FALSE,'Name' => 'Faspay'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['SettingFaspay'] = [];
        $SettingFaspay = $this->m_settings->getSettingFaspay();
        $data['SettingFaspay'] = $SettingFaspay;
        $this->load->view('adminpanel/settings/faspay/edit', $data);
    }

    public function midtrans() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Mid Trans',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/midtrans'],
                ['isUrl' => FALSE,'Name' => 'Mid Trans'],
            ]
        ];
        $data = $this->globalFunction($data);
        $data['SettingMidtrans'] = [];
        $SettingMidtrans = $this->m_settings->getSettingMidtrans();

        $SettingMidtrans->IsProduction = $SettingMidtrans->IsProduction == 1 ? true : false;
        $PaymentMethod = explode(",", $SettingMidtrans->PaymentMethod);

        $ChoosenMethod = [];
        $ListPayment = ["credit_card", "mandiri_clickpay", "cimb_clicks", "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "indosat_dompetku", "mandiri_ecash", "permata_va", "bca_va", "bni_va", "other_va", "gopay", "kioson", "indomaret", "gci", "danamon_online"];
        foreach ($ListPayment as $key => $value) {
            if (in_array($value, $PaymentMethod)) {
                $ChoosenMethod[$value] = true;
            }
            else {
                $ChoosenMethod[$value] = false;
            }
        }
        $SettingMidtrans->IsAutoPaymentLink = $SettingMidtrans->IsAutoPaymentLink == 1 ? true : false;
        $SettingMidtrans->PaymentMethod = $ChoosenMethod;
        $data['SettingMidtrans'] = $SettingMidtrans;
        $this->load->view('adminpanel/settings/midtrans/edit', $data);
    }

    public function opsitools() {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Opsitools API',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Setting', 'Url' => 'settings/opsitools'],
                ['isUrl' => FALSE,'Name' => 'Opsitools API'],
            ]
        ];
        $data = $this->globalFunction($data);

        $OpsitoolsListApi = $this->m_settings->getOpsitoolsListApi();
        $OpsitoolsAuth = $this->m_settings->getOpsitoolsAuth();

        $ListApi['token'] = array_search('token', array_column($OpsitoolsListApi, 'ListName'));
        $ListApi['FlightAvailability'] = array_search('FlightAvailability', array_column($OpsitoolsListApi, 'ListName'));
        $ListApi['RsvFlight'] = array_search('RsvFlight', array_column($OpsitoolsListApi, 'ListName'));
        $ListApi['FareDetail'] = array_search('FareDetail', array_column($OpsitoolsListApi, 'ListName'));
        $ListApi['GetRsvById'] = array_search('GetRsvById', array_column($OpsitoolsListApi, 'ListName'));
        $ListApi['IssueRsvFlight'] = array_search('IssueRsvFlight', array_column($OpsitoolsListApi, 'ListName'));

        $data['ListApiId'] = $ListApi;
        $data['OpsitoolsListApi'] = $OpsitoolsListApi;
        $data['OpsitoolsAuth'] = $OpsitoolsAuth;
        $this->load->view('adminpanel/settings/opsitools/edit', $data);
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

        $data['ViewHead']           = $this->load->view('adminpanel/template/head', $data, TRUE);
        $data['ViewPreLoader']      = $this->load->view('adminpanel/template/preloader', [], TRUE);
        $data['ViewFooter']         = $this->load->view('adminpanel/template/footer', [], TRUE);
        $data['ViewLeftPanel']      = $this->load->view('adminpanel/template/left_panel', $data, TRUE);
        $data['ViewHeaderBar']      = $this->load->view('adminpanel/template/header_bar', $data['HeaderBar'], TRUE);
        $data['ViewCopyRight']      = $this->load->view('adminpanel/template/copyright', [], TRUE);
        return $data;
    }

}