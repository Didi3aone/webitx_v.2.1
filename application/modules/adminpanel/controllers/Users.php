<?php

class Users extends CI_Controller
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
            'LeftMenuTitle'     => 'Add New Users',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Page', 'Url' => 'users'],
                ['isUrl' => FALSE,'Name' => 'Users'],
            ]
        ];
        $data = $this->globalFunction($data);

        $data['Member']         = $this->ion_auth->user()->row();
        $data['List']           = [];
        // $data['List']   = $this->m_manages->getListUsers();
        $Users = $this->ion_auth->users()->result();
        foreach ($Users as $key => $value) {
            $User = [
                'UserId'        => $value->id,
                'UserName'      => $value->username,
                'Email'         => $value->email,
                'FirstName'     => $value->first_name,
                'LastName'      => $value->last_name,
                'Group'         => $this->ion_auth->get_users_groups($value->id)->row()
            ];
            $data['List'][] = $User;
        }

        usort($data['List'], function($a, $b) {
            return $a['Group']->id - $this->ion_auth->user()->row()->id;
            // return $a['Group']->id - $b['Group']->id;
        });

        // echo "<pre>";
        // print_r($data['List']);
        // die();
        $this->load->view('adminpanel/users/all', $data);
    }

    public function add($UserId=false) {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Edit Users',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Users', 'Url' => 'users/add'],
                ['isUrl' => FALSE,'Name' => 'Edit Users'],
            ]
        ];
        $data = $this->globalFunction($data);

        // $this->ion_auth->add_to_group(2, 3);

        // $data['UserGroup'] = $this->ion_auth->get_users_groups(6)->row();
        $MemberData = [];
        if ($UserId) {
            $Member         = $this->ion_auth->user($UserId)->row();
            if (!$Member) die('');


            $MemberData = [
                'MemberId'      => $Member->id,
                'UserName'      => $Member->username,
                'Email'         => $Member->email,
                'FirstName'     => $Member->first_name,
                'LastName'      => $Member->last_name,
                'Phone'         => $Member->phone,
                'Password'      => $Member->password,
                'Type'          => $Member->type,
                'Group'         => $this->ion_auth->get_users_groups($Member->id)->row()->id
            ];
        }
        $data['UserId']     = $UserId ? $UserId : 0;
        $data['MemberData'] = $MemberData;

        // echo "<pre>";
        // print_r($MemberData);
        // print_r($this->ion_auth->users()->result());
        // die();

        $this->load->view('adminpanel/users/add', $data);
    }

    public function requests(){
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Users Request',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Users', 'Url' => 'users'],
                ['isUrl' => FALSE,'Name' => 'User Requests'],
            ]
        ];
        $data = $this->globalFunction($data);

        $data['Member']         = $this->ion_auth->user()->row();
        $data['List']           = [];
        // $data['List']   = $this->m_manages->getListUsers();
        // $Users = $this->ion_auth->users()->result();
        $listUserReq = $this->db->query(
            "select users.id, users.username, users.email, users.phone, users.first_name, users.last_name, users.nik, users_requestv2.type, users_requestv2.status_request, gender, birth_date, img_thum, users_requestv2.buyer_type 
            from users 
            inner join users_requestv2 on users.id = users_requestv2.user_id"
            )->result(); 
        foreach ($listUserReq as $key => $value) {
            $privyId = $this->db->query("select * from users_privyid where user_id='".$value->id."'")->row();
            $company = $this->db->query("select * from users_mitra where id='".$value->id."'")->row();
            $contact = $this->db->query("select * from users_contact where user_id='".$value->id."'")->row();
            $bank = $this->db->query("select * from users_bank where user_id='".$value->id."'")->row();
            $User = [
                'UserId'        => $value->id,
                'UserName'      => $value->username,
                'Email'         => $value->email,
                'Phone'         => $value->phone,
                'FirstName'     => $value->first_name,
                'LastName'      => $value->last_name,
                'Gender'        => $value->gender,
                'BirthDate'     => $value->birth_date,
                'Nik'           => $value->nik,
                'Img'           => $value->img_thum ? base_url().'assets/images/profile/'.$value->img_thum : base_url().'assets/images/profile/profile.png',
                'ReqType'       => $value->type ? ($value->type == 2 ? $value->buyer_type : 'seller') : 'NoRequest',
                'Status'        => $value->status_request ? $value->status_request : 'undefined',
                'PrivyId'       => $privyId ? $privyId->privy_id : 'empty',
                'PrivyIdStatus' => $privyId ? ($privyId->status ? $privyId->status : 'empty') : 'empty',
                'Group'         => $this->ion_auth->get_users_groups($value->id)->row(),
                'Company'       => [
                                    'Brand'     => $company ? ($company->brand ? $company->brand : '') : '',
                                    'Name'      => $company ? ($company->mitra_name ? $company->mitra_name : '') : '',
                                    'Owner'     => $company ? ($company->owner ? $company->owner : '') : '',
                                    'Phone'     => $company ? ($company->phone_no ? $company->phone_no : '') : '',
                                    'Mobile'    => $company ? ($company->mobile_no ? $company->mobile_no : '') : '',
                                    'Address'   => $company ? ($company->address ? $company->address : '') : '',
                                    'District'  => $company ? ($company->sub_district ? $company->sub_district : '') : '',
                                    'Province'  => $company ? ($company->province ? $company->province : '') : '',
                                    'City'      => $company ? ($company->city ? $company->city : '') : '',
                                    'Email'     => $company ? ($company->email ? $company->email : '') : '',
                                    'Website'   => $company ? ($company->website ? $company->website : '') : '',
                                    'Postal'    => $company ? ($company->postal_code ? $company->postal_code : '') : '',
                                    'Logo'      => $company ? ($company->logo ? base_url().'assets/images/logo/'.$company->logo : base_url().'assets/images/profile/profile.png') :base_url().'assets/images/profile/profile.png',
                                    ],
                'Contact'       => [
                                    'Name'      => $contact ? ($contact->name ? $contact->name : '') : '',
                                    'Email'     => $contact ? ($contact->email ? $contact->email : '') : '',
                                    'Phone'     => $contact ? ($contact->phone ? $contact->phone : '') : '',
                                    'Mobile'    => $contact ? ($contact->mobile ? $contact->mobile : '') : '',
                                    'NameOps'   => $contact ? ($contact->name_ops ? $contact->name_ops : '') : '',
                                    'EmailOps'  => $contact ? ($contact->email_ops ? $contact->email_ops : '') : '',
                                    'PhoneOps'  => $contact ? ($contact->phone_ops ? $contact->phone_ops : '') : '',
                                    'MobileOps' => $contact ? ($contact->mobile_ops ? $contact->mobile_ops : '') : '',
                                    ],
                'Bank'          => [
                                    'BankName'  => $bank ? ($bank->bank_name ? $bank->bank_name : '') : '',
                                    'Account'   => $bank ? ($bank->bank_account ? $bank->bank_account : '') : '',
                                    'BankUser'  => $bank ? ($bank->bank_user ? $bank->bank_user : '') : '',
                                    ],

            ];
            if($User['ReqType'] == 'seller'){
                $reqType = 1;
            }else if($User['ReqType'] == '1'){
                $reqType = 21;
            }else if($User['ReqType'] == '2'){
                $reqType = 22;
            }else if($User['ReqType'] == '3'){
                $reqType = 23;
            }else{
                $reqType = '';
            }

            $doc = $this->db->query("select * from users_document_det where user_id='".$value->id."' and request_type = '".$reqType."'")->result();
            if($doc){
                foreach($doc as $k => $v){
                    $sign = $this->db->query('select * from users_privyid_doc where user_id = "'.$value->id.'" and doc_id = "'.$v->doc_id.'"')->row();
                    $User['Document'][] = [
                        'Id'        => $v->doc_id,
                        'UserId'    => $value->id,
                        'Name'      => $v->doc_name,
                        'Url'       => base_url().'assets/generate_pdf/'.$v->doc_name,
                        'SignUrl'   => $sign ? ($sign->doc_url ? $sign->doc_url : 'empty') : 'empty',
                        'Status'    => $v->status,
                        'PrivyId'   => $User['PrivyId']
                        // 'Owner'     => [
                        //     'privyId' => '',
                        //     'enterpriseToken' => ''
                        // ],
                        // 'Recipients' => [
                        //     [
                        //         'privyId' => '',
                        //         'type' => 'Signer',
                        //         'enterpriseToken' => ''
                        //     ],
                        //     [
                        //         'privyId' => '',
                        //         'type' => 'Signer',
                        //         'enterpriseToken' => ''
                        //     ]
                        // ]
                    ];
                    // if($v && $v->status != 'undefined'){
                    //     $this->privyDocStatus($v->doc_id);
                    // }
                }
            }

            $data['List'][] = $User;
            $this->privyUserStatus($User['UserId'], $User['ReqType'], $User['Status']);
            // echo json_encode($value);
            // if($privySeller){
            //     $this->privyUserStatus($value->id, 'seller');
            // }

            // if($privyBuyer){
            //     $this->privyUserStatus($value->id, 'buyer');
            // }
        }
        // echo json_encode($data['List']);
        // die();
        usort($data['List'], function($a, $b) {
            return $a['Group']->id - $b['Group']->id;
        });


        // echo "<pre>";
        // echo json_encode($data['List']);
        // die();
        $this->load->view('adminpanel/users/requests', $data);
    }

    public function userDetail()
    {
        $this->load->view('adminpanel/users/user_detail');
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

    public function privyUserStatus($userid, $type, $stat)
    {
        // $user = $this->ion_auth->user()->row();
        $privy = $this->db->query('select * from privyid_api')->row();
        $privyUser = $this->db->query('select * from users_privyid where user_id = "'.$userid.'"')->row();
        // $privyUserDet = $this->db->query('select * from users_privyid where user_id = "'.$userid.'" and type="'.$type.'"')->row();
        if($privyUser){
        $url = $privy->base.$privy->reg_status;
        $data = [
            'auth' => [$privy->user,$privy->pass],
            'form_params' => [
                'token' => $privyUser ? $privyUser->token : '',
            ],
            'headers' => [
                'Merchant-Key' => $privy->merchant_key
            ]
        ];
        
        
        $this->load->library('privyid_api');
        $resp = $this->privyid_api->postPrivyAPI($url, $data);
        $r = json_decode($resp);
        // echo $resp;die();

        if($r->code == 201){

            $this->load->model('m_update');

            if($r->data->status == 'waiting'){
                $stat = 2;
            }else if($r->data->status == 'rejected'){
                $stat = 5;
            }else if($r->data->status == 'verified' || $r->data->status == 'registered'){
                if($stat != 4){
                    $stat = 3;
                }
                $dataUpdate = [
                    'table' => 'users_privyid',
                    'where' => ['user_id' => $userid],
                    'data'  => ['status' => strtolower($r->data->status), 'privy_id' => $r->data->privyId]
                ];
                $this->m_update->updateDynamic($dataUpdate);
            }

            if($type == 'seller'){
                $datawhere = ['user_id' => $userid, 'type' => 1, 'status_request!=' => 5];
            }else{
                $datawhere = ['user_id' => $userid, 'buyer_type' => $type, 'status_request!=' => 5];
            }

            if($stat != 4){
                $dataUpdate2 = [
                    'table' => 'users_requestv2',
                    'where' => $datawhere,
                    'data' => [ 'status_request' => $stat]
                ];
                $this->m_update->updateDynamic($dataUpdate2);
            }
        }
        }

    }
        

    // public function privyDocStatus($docid)
    // {
    //     $privy = $this->db->query('select * from privyid_api')->row();
    //     $doc = $this->db->query('select * from users_privyid_doc where doc_id = "'.$docid.'"')->row();
    //     $url = $privy->base.$privy->doc_status.'/'.$doc->doc_token;
    //     $data = [
    //         'auth' => [$privy->user,$privy->pass],
    //         'headers' => [
    //             'Merchant-Key' => $privy->merchant_key,
    //         ]
    //     ];
                
    //     $this->load->library('privyid_api');
    //     $resp = $this->privyid_api->getPrivyAPI($url, $data);
    //     $r = json_decode($resp);
    //     // echo $resp;
    //     if($r->code == 200){
    //         $dataUpdate = [
    //             'table' => 'users_privyid_doc',
    //             'where' => ['doc_id' => $docid],
    //             'data'  => ['status' => strtolower($r->data->documentStatus)]
    //         ];
    //         $dataUpdate2 = [
    //             'table' => 'users_document_det',
    //             'where' => ['doc_id' => $docid],
    //             'data'  => ['status' => strtolower($r->data->documentStatus)]
    //         ];

    //         $this->load->model('m_update');
    //         $this->m_update->updateDynamic($dataUpdate);
    //         $this->m_update->updateDynamic($dataUpdate2);
    //     }

    // }


}