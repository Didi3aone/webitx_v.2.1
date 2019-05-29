<?php

class Crud_user extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_update');
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
            die();
    }

    public function deleteUser()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $UserId = $InputData['UserId'];
        $Return['StatusResponse'] = 0;
        if ($this->ion_auth->delete_user($UserId)) {
            $Return['StatusResponse'] = 1;
        }
        echo json_encode($Return);
    }

    public function getDocument()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $UserId = $InputData['UserId'];

        $document = $this->db->query('select * from users_document where user_id = "'.$UserId.'"')->row();

        $data = [
            'ktp'  => [
                'name'  => $document ? ($document->scan_ktp ? $document->scan_ktp : '' ) : '',
                'url'   => $document ? ($document->scan_ktp ? base_url().'assets/file_upload/'.$document->scan_ktp : '') : ''
            ],
            'selfie'  => [
                'name'  => $document ? ($document->scan_selfie ? $document->scan_selfie : '' ) : '',
                'url'   => $document ? ($document->scan_selfie ? base_url().'assets/file_upload/'.$document->scan_selfie : '') : ''
            ],
            'npwp'  => [
                'name'  => $document ? ($document->scan_npwp ? $document->scan_npwp : '' ) : '',
                'url'   => $document ? ($document->scan_npwp ? base_url().'assets/file_upload/'.$document->scan_npwp : '') : ''
            ],
            'siup'  => [
                'name'  => $document ? ($document->scan_siup ? $document->scan_siup : '' ) : '',
                'url'   => $document ? ($document->scan_siup ? base_url().'assets/file_upload/'.$document->scan_siup : '') : ''
            ],
            'akta'  => [
                'name'  => $document ? ($document->scan_akta ? $document->scan_akta : '' ) : '',
                'url'   => $document ? ($document->scan_akta ? base_url().'assets/file_upload/'.$document->scan_akta : '') : ''
            ],
            'sk'  => [
                'name'  => $document ? ($document->scan_sk ? $document->scan_sk : '' ) : '',
                'url'   => $document ? ($document->scan_sk ? base_url().'assets/file_upload/'.$document->scan_sk : '') : ''
            ]
        ];

        echo json_encode($data);
    }

    public function acceptSeller(){
        $InputData = json_decode(file_get_contents('php://input'),true);
        $Return['StatusResponse'] = 0;
        $type = 'seller_status';

        $this->submitPrivyId($InputData, $type);
        
    }

    public function acceptRequest(){
        $InputData = json_decode(file_get_contents('php://input'),true);

        $Return['StatusResponse'] = 0;

        $this->submitPrivyId($InputData);
        // $dataUpdate = [
        //     'table' => 'users_requestv2',
        //     'where' => ['user_id' => $UserId, 'type' => $ReqType],
        //     'data'  => ['status_request' => 2]
        // ];
        // if ($this->m_update->updateDynamic($dataUpdate)) {
        //     $Return['StatusResponse'] = 1;
        // }
        // echo json_encode($Return);
    }

    public function rejectRequest(){
        $InputData = json_decode(file_get_contents('php://input'),true);
        $Remark = $InputData['Remark'];
        $UserId = $InputData['UserId'];
        $ReqType = $InputData['ReqType'];

        if($ReqType == 'seller'){
            $datawhere = ['user_id' => $UserId, 'type' => 1, 'status_request!=' => 5];
        }else{
            $datawhere = ['user_id' => $UserId, 'buyer_type' => $ReqType, 'status_request!=' => 5];
        }

        $Return['StatusResponse'] = 0;
        $dataUpdate = [
            'table' => 'users_requestv2',
            'where' => $datawhere,
            'data'  => ['status_request' => 5, 'reason_reject' => $Remark]
        ];
        if ($this->m_update->updateDynamic($dataUpdate)) {
            $Return['StatusResponse'] = 1;
        }
        echo json_encode($Return);
    }

    public function getReasonReject(){
        $InputData = json_decode(file_get_contents('php://input'),true);
        $ReqType = $InputData['ReqType'];
        $UserId = $InputData['UserId'];

        if($ReqType == 'seller'){
            $query = 'select reason_reject from users_requestv2 where user_id = "'.$UserId.'" and type = 1';
        }else{
            $query = 'select reason_reject from users_requestv2 where user_id = "'.$UserId.'" and type = 2 and buyer_type = "'.$ReqType.'"';
        }
        $resp = $this->db->query($query)->row();

        echo json_encode($resp);
    }

    public function submitPrivyId($InputData)
    {
        //Submit to PrivyId
        $Return['StatusResponse'] = 0;
        $privy = $this->db->query('select * from privyid_api')->row();
        $doc = $this->db->query('select scan_ktp, scan_selfie from users_document where user_id ="'.$InputData['UserId'].'"')->row();
        $url = $privy->base.$privy->reg;
        $data = [
            'auth' => [$privy->user,$privy->pass],
            'headers' => [
                'Merchant-Key' => $privy->merchant_key
            ],
            'multipart' => [
                [
                    'name' => 'selfie',
                    'contents' => fopen('./assets/file_upload/'.$doc->scan_selfie, 'r')
                ],
                [
                    'name' => 'ktp',
                    'contents' => fopen('./assets/file_upload/'.$doc->scan_ktp, 'r')
                ],
                [
                    'name' => 'email',
                    'contents' => $InputData['Email'],
                ],
                [
                    'name' => 'phone',
                    'contents' => $InputData['Phone'],
                ],
                [
                    'name' => 'identity',
                    'contents' => json_encode(
                        [
                            'nik' => $InputData['Nik'],
                            'nama' => $InputData['FirstName'].' '.$InputData['LastName']
                        ]
                    )
                ]
            ]  
        ];
        
        $this->load->library('privyid_api');
        $resp = $this->privyid_api->postPrivyAPI($url, $data);
        $r = json_decode($resp);
        // echo $r->code;die();
        // echo $resp;
        
        if($r->code == 201){

            if($InputData['ReqType'] == 'seller'){
                $datawhere = ['user_id' => $InputData['UserId'], 'type' => 1, 'status_request!=' => 5];
            }else{
                $datawhere = ['user_id' => $InputData['UserId'], 'buyer_type' => $InputData['ReqType'], 'status_request!=' => 5];
            }

            $dataUpdate = [
                'table' => 'users_requestv2',
                'where' => $datawhere,
                'data'  => [ 'status_request' => '2']
            ];

            $this->m_update->updateDynamic($dataUpdate);
        
            $dataUser = [
                'email' => $r->data->email,
                'phone' => $r->data->phone,
                'token' => $r->data->userToken,
                'status' => strtolower($r->data->status),
                'created_date' => date('Y-m-d H:i:s'),
                'user_id' => $InputData['UserId']
            ];

            $dataInsert = [
                'table' => 'users_privyid',
                'data' => $dataUser
            ];
            
            $this->load->model('m_insert');
            $this->m_insert->insertDynamic($dataInsert);

            $Return['StatusResponse'] = 1;
        }else if($r->code == 422){
            $Return['Message'] = $r->errors[0]->messages;
        }
        
        echo json_encode($Return);
    }

    public function submitDokumen(){
        $InputData = json_decode(file_get_contents('php://input'),true);
        $Return['StatusResponse'] = 0;
        
        $this->privyDocUpload($InputData);
        
    }

    public function submitAllDokumen()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);

        foreach($InputData as $key => $value){
            if($value['Status'] == 'new'){
                $this->privyDocUpload($value);
            }
        }
    }

    public function checkDokumenStatus()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $UserId = $InputData['UserId'];
        $DocList = $InputData['Document'];
        $ReqStatus = $InputData['Status'];
        $ReqType = $InputData['ReqType'];

        foreach($DocList as $key => $value){
            if($value['Status'] != 'new'){
                $this->privyDocStatus($value['Id'], $UserId, $ReqType, $ReqStatus);
            }           
        }
    }

    public function privyDocUpload($InputData){
        $Return['StatusResponse'] = 0;
        $privy = $this->db->query('select * from privyid_api')->row();
        $url = $privy->base.$privy->doc_upload;
        $data = [
            'auth' => [$privy->user,$privy->pass],
            'headers' => [
                'Merchant-Key' => $privy->merchant_key,
            ],
            'multipart' => [
                [
                    'name' => 'documentTitle',
                    'contents' => $InputData['Name']
                ],
                [
                    'name' => 'docType',
                    'contents' => 'Parallel'
                ],
                [
                    'name' => 'owner',
                    'contents' => json_encode([
                        'privyId' => $privy->privy_id,
                        'enterpriseToken' => $privy->enterprise_token
                    ])
                ],
                [
                    'name' => 'document',
                    'contents' => fopen('./assets/generate_pdf/'.$InputData['Name'], 'r')
                ],
                [
                    'name' => 'recipients',
                    'contents' => json_encode([
                            [
                                'privyId' => $privy->privy_id,
                                'type' => 'Signer',
                                'enterpriseToken' => $privy->enterprise_token
                            ],
                            [
                                'privyId' => $InputData['PrivyId'],
                                'type' => 'Signer',
                                'enterpriseToken' => ''
                            ]
                        ])
                ],

            ]

        ];
                
        $this->load->library('privyid_api');
        $resp = $this->privyid_api->postPrivyAPI($url, $data);
        $r = json_decode($resp);
        // echo $resp;
        if ($r->code == 201) {
            $this->load->model('m_insert');
            $docData = [
                'doc_id'   => $InputData['Id'],
                'doc_name' => $InputData['Name'],
                'doc_token' => $r->data->docToken,
                'doc_url' => $r->data->urlDocument,
                'status' => 'in progress',
                'posted_date' => date('Y-m-d H:i:s'),
                'user_id' => $InputData['UserId']
            ];
            $dataInsert = [
                'table' => 'users_privyid_doc',
                'data'  => $docData
            ];
            $this->m_insert->insertDynamic($dataInsert);

            $dataUpdate = [
                'table' => 'users_document_det',
                'where' => ['doc_id' => $InputData['Id']],
                'data' => ['status' => 'in progress']
            ];
            $this->m_update->updateDynamic($dataUpdate);

            $Return['StatusResponse'] = 1;
        }else if($r->code == 422){
            $Return['Message'] = $r->errors[0]->messages;
        }
        echo json_encode($Return);
    }

    public function privyDocStatus($docid, $userid, $reqtype, $reqstatus)
    {
        
        $privy = $this->db->query('select * from privyid_api')->row();
        $doc = $this->db->query('select * from users_privyid_doc where doc_id = "'.$docid.'"')->row();
        $url = $privy->base.$privy->doc_status.'/'.$doc->doc_token;
        $data = [
            'auth' => [$privy->user,$privy->pass],
            'headers' => [
                'Merchant-Key' => $privy->merchant_key,
            ]
        ];
                
        $this->load->library('privyid_api');
        $resp = $this->privyid_api->getPrivyAPI($url, $data);
        $r = json_decode($resp);
        // echo $resp;
        if($r->code == 200){
            $dataUpdate = [
                'table' => 'users_privyid_doc',
                'where' => ['doc_id' => $docid],
                'data'  => ['status' => strtolower($r->data->documentStatus)]
            ];
            $dataUpdate2 = [
                'table' => 'users_document_det',
                'where' => ['doc_id' => $docid],
                'data'  => ['status' => strtolower($r->data->documentStatus)]
            ];

            $this->load->model('m_update');
            $this->m_update->updateDynamic($dataUpdate);
            $this->m_update->updateDynamic($dataUpdate2);

            if($r->data->documentStatus == 'Completed'){

                if($reqtype == 'seller'){
                    $datawhere = ['user_id' => $userid, 'type' => 1, 'status_request!=' => 5];
                }else{
                    $datawhere = ['user_id' => $userid, 'buyer_type' => $reqtype, 'status_request!=' => 5];
                }

                $dataUpdate3 = [
                    'table' => 'users_requestv2',
                    'where' => $datawhere,
                    'data'  => ['status_request' => 4]
                ];
                $this->m_update->updateDynamic($dataUpdate3);
            }
            echo json_encode($r->data->documentStatus);
        }
        
    }

    public function editUser()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $UserData = $this->general->filtering_datas($InputData['data']);
        $Return['StatusResponse'] = 0;

        $UserName = '';
        if ($UserData['Group'] == 1) {
            $UserName = $UserData['UserName'];
        }
        else if ($UserData['Group'] == 2) {
            $UserName = $UserData['UserName'];
        }

        // --- Edit Password --- //
        if (isset($UserData['Password1']) && isset($UserData['Password2']) ) {
            if ($UserData['Password1'] != $UserData['Password2']) {
                $Return['Message'] = 'Password Not match';
                echo json_encode($Return);
                die();
            }
            else {
                $user = $this->ion_auth->user($UserData['MemberId'])->row();
                $Password = $this->ion_auth->reset_password($user->email, $UserData['Password1']);
                $Return['user'] = $user;
            }
        }
        else {
            $Password = false;
        }
        // --- End Password --- //

        $dataUser = array(
            'first_name'    => $UserData['FirstName'],
            'last_name'     => $UserData['LastName'],
            'username'      => $UserName,
            'updated_date'  => date('Y-m-d H:i:s'),
            'phone'         => $UserData['Phone']
        );

        if ($this->ion_auth->update($UserData['MemberId'], $dataUser))
        {
            $this->ion_auth->set_message_delimiters('<p><strong>','</strong></p>');
            $messages = $this->ion_auth->messages();
            $Return['StatusResponse'] = 1;
        }
        else
        {
            $this->ion_auth->set_error_delimiters('<p><strong>','</strong></p>');
            $errors = $this->ion_auth->errors();
            $Return['Message'] = $errors;
        }

        $Return['UserData'] = $UserData;
        $Return['Message']  = '';
        echo json_encode($Return);
    }

    // -------------------------------------------------- BANK -------------------------------------------------- //
    function addUser()
    {
        $InputData = json_decode(file_get_contents('php://input'),true);
        $UserData = $this->general->filtering_datas($InputData['data']);
        $Return = ['StatusResponse'=>0, 'Message'=>'', 'Data'=> $UserData];
        
        
        if ($UserData['Password1'] != $UserData['Password2']) {
            $Return['Message'] = 'Password Not match';
            echo json_encode($Return);
            die();
        }

        $AdditionalData = array(
            'first_name'    => $UserData['FirstName'],
            'last_name'     => $UserData['LastName'],
            'phone'         => $UserData['Phone'],
            'status'        => 1,
            'type'          => $UserData['Group'] == 1 ? 2 : 5,
            'created_date'  => date('Y-m-d H:i:s'),
            'created_by'    => 0
        );
    
        $this->ion_auth->register($UserData['UserName'], $UserData['Password1'], $UserData['Email'], $AdditionalData, [$UserData['Group']]);

        $Return['StatusResponse'] = 1;
        echo json_encode($Return);
    }

}