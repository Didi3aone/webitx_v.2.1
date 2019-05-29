<?php

class Crud_page extends CI_Controller
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

    
    function publishPage()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $InputData = $this->general->filtering_datas($InputData);

        $PageId = $InputData['PageId'];
        $Status = $InputData['Status'];
        $Return = ['StatusResponse'=>0, 'Message'=>''];
        $this->load->model('m_update');
        $dataPage = [
            'data'  => [
                'status'        => $Status,
                'updateddate'   => date("Y-m-d H:i:s")
            ],
            'table' => 'v2_master_page',
            'where'     => ['id' => $PageId],
        ];
        $this->m_update->updateDynamic($dataPage);
        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }



    function editPage() {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $PageData = $InputData['data'];
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $PageData];
        $this->load->model('m_update');

        $dataEmail = [            
            'nav_name'              => $this->general->filtering_datas($PageData['NavName']),
            'name'                  => $this->general->filtering_datas($PageData['TitleName']),
            'subtitle'              => $this->general->filtering_datas($PageData['SubTitle']),
            'seourl'                => $this->general->filtering_datas($PageData['SeoUrl']),
            'status'                => $PageData['IsPublish'] ? 0 : 1,
            'redirect_url'          => $PageData['RedirectUrl'] != '' ? $PageData['RedirectUrl'] : null,
            'metakeyword'           => $this->general->filtering_datas($PageData['MetaKeyword']),
            'metadescription'       => $this->general->filtering_datas($PageData['MetaDescription']),
            'description'           => $PageData['Description']
        ];
        $dataEmail = $dataEmail;

        $UpdateEmail = [
            'data'  => $dataEmail,
            'table' => 'v2_master_page',
            'where'     => ['id' => $PageData['PageId']],
        ];
        if($this->session->flashdata('uploadImageCoverPage')) {
            $UpdateEmail['data']['imgcover'] = $this->session->flashdata('uploadImageCoverPage');
        }
        $this->m_update->updateDynamic($UpdateEmail);
        $Return['StatusResponse'] = 1;
        $Return['Data'] = $dataEmail;
        echo json_encode($Return);
    }

}