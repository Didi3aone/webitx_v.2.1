<?php

use Dompdf\Dompdf;
/**
 * @package Member
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @since [< version 2.1 > mei-2019] [<lts version>]
 */
class Member extends MX_Controller
{

    private $_view = 'member/';
    protected $data;
    protected $data_header;
    protected $data_footer;

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation', 'general','ion_auth'));
        // $this->load->helper(array('language', 'form'));
        $this->load->model('m_general');
        $this->general->saveVisitor($this, [1, 0]);
        $this->data = array();
        $this->data_header = array();
        $this->data_footer = array();
    }

    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }

    /**
     * [index ui login]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function index() //before was login()
    {        
        $this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Member';
        $this->data_header['breadcrumb_child'] = 'Login';
        $this->data['form_title']       = 'User Login';

        $this->data_footer['view_js'] = $this->_view.'javascript/login_js';

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'member-login', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
    }

    /**
     * [register]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function register()
    {
        $this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Member';
        $this->data_header['breadcrumb_child'] = 'Register';
        $this->data['title_form']       = 'User Registration';

        $this->data_footer['view_js'] = $this->_view.'javascript/register_js';

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'member-register', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
    }

    /**
     * [logout]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function logout()
    {
        // log the user out
        $logout = $this->ion_auth->logout();
        // redirect them to the landing page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('login', 'refresh');
    }

    
    /**
     * [personalData]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [array] 
     */
    public function personalData()
    {
        // redirect them to the login page if not logged in or is login as admin
        if ( !$this->ion_auth->logged_in() || $this->ion_auth->user()->row()->type < 5 )
            redirect(base_url('login'), 'refresh');

        //get id user login
        $user_id = $this->ion_auth->user()->row()->id;

        $this->data_header['is_breadcrumb']    = 'none';
        $this->data_footer = array(
            'view_js' => array(
                'javascript/account_js'
            )
        );

        //prepare set param data
        $this->data['profile'] = $this->Global_model->set_model('users','u','id')->mode(array(
            'type'          => 'single_row',
            'conditions'    => array(
                'u.id' => $user_id
            )
        )); 

        //prepare get data
        //first get mitra info
        $this->data['mitra_info'] = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
            'type'          => 'single_row',
            'conditions'    => array(
                'user_id'   => $user_id
            ),
            'return_object' => TRUE,
            'debug_query'   => false
        ));

        $sub_district = ($this->data['mitra_info']) ? $this->data['mitra_info']->sub_district :""; 
        // print_r($this->data['mitra_info']);die;
        //dropdown kecamatan
        $this->data['kecamatan'] = $this->Global_model->set_model('mst_districts','md','id')->mode(array(
            'type' => 'all_data'
        ));

        $this->data['kecamatans'] = $this->Global_model->set_model('mst_districts','md','id')->mode(array(
            'type' => 'all_data',
            'conditions' => array(
                'name !=' => $sub_district
            ),
            'return_object' => true
        ));

        $this->data['dokumen'] = $this->Global_model->set_model('users_document','ud','id')->mode(array(
            'type'          => 'single_row',
            'conditions'    => array(
                'user_id'   => $user_id
            ),
            'debug_query'   => false
        ));

        $this->data['bank'] = $this->Global_model->set_model('users_bank','ub','bank_id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $user_id
            )
        ));

        $this->data['contact'] = $this->Global_model->set_model('users_contact','uc','contact_id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $user_id
            )
        ));

        $this->data['dokumen'] = $this->Global_model->set_model('users_document','ud','id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $user_id
            )
        ));

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'member-profile', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
    }

    /**
     * [change_password]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [void] 
     */
    public function change_password()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        $this->form_validation->set_rules('newpass', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('newconfirm', 'Password Confirmation', 'trim|required|matches[newpass]');

        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']    = true;
            $message['error_msg']   = trim(strip_tags(validation_errors()));
        } else {
            $user = $this->ion_auth->user()->row();

            $oldpass = $this->input->post('oldpass');
            $newpass = $this->input->post('newpass');

            $check = $this->ion_auth->hash_password_db($user->id, $oldpass);

            if($check == TRUE){
                $data = array(
                    'password' => $this->ion_auth->hash_password($newpass)
                );

                $result = $this->Global_model->set_model('users','u','id')->mode(array(
                    'type'  => 'update',
                    'datas' => $data,
                    'conditions' => array(
                        'id' => $user->id
                    )
                ));

                if($result) {
                    $message['is_error']    = false;
                    $message['success_msg'] = 'Success change password';
                } else {
                    $message['is_error']    = true;
                    $message['success_msg'] = 'Database operation failed';
                }

            }else{
                $message['is_error']    = true;
                $message['success_msg'] = 'Wrong password';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }


    /**
     * [_set_rule_validation]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [void] 
     */
    private function _set_rule_validation() 
    {

        //prepping to set no delimiters.
        $this->form_validation->set_error_delimiters('', '');
        $data = $this->input->post();
        //validates.
        //special validations for when editing.
        $this->form_validation->set_rules('buyer_type','Type Buyer','required');
        if( $data['buyer_type'] == API ) {
            $this->form_validation->set_rules('agree_nda_check', 'Check NDA', "required");
            $this->form_validation->set_rules('ip_dev_1','IP DEVELOPMENT','trim|required');
            $this->form_validation->set_rules('ip_production','IP PRODUCTION','trim|required');
            $this->form_validation->set_rules('agree_policy_check_buyer','Check Policy','required');
            $this->form_validation->set_rules('agree_ip_whitelist','Check IP Whitelist','required');
        }
    }

    /**
     * [myrequest]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [void] 
     */
    public function myrequest()
    {
        $this->load->model('Global_model');
        $this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Member';
        $this->data_header['breadcrumb_child'] = 'My Request';
        $this->data_footer['view_js'] = $this->_view.'javascript/request_js';

        $this->data['title_table'] = "List My Request";
        $this->data['reques'] = $this->Global_model->set_model('users_requestv2','ur','id')->mode(array(
            'type' => 'all_data',
            'select' => 'ur.*,upd.doc_url',
            'left_joined' => array(
                'users_privyid_doc upd' => array(
                    'upd.user_id' => 'ur.user_id'
                ) 
            ),
            'conditions' => array(
                'ur.user_id' => $this->ion_auth->user()->row()->id,
            ),
            'debug_query' => false
        ));

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'my-request', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
    }

    /**
     * [cancel request]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [void] 
     */
    public function cancel_request()
    {
        $this->load->model('Global_model');
        $id     = $this->input->post('id');
        $type   = $this->input->post('tipe');

        $message['is_error'] = true;
        $message['message']  = '';
        if( !empty($id) ) {
            $update_cancel = array(
                'status_request' => CANCEL_REQUEST,
                'is_request'     => CANCEL_REQUEST
            );

            $result = $this->Global_model->set_model('users_requestv2','ur','id')->mode(array(
                'type' => 'update',
                'datas' => $update_cancel,
                'conditions' => array(
                    'id' => $id,
                )
            ));


            if( $result ) {
                $results = $this->Global_model->set_model('users_buyer','ub','id')->mode(array(
                    'type' => 'update',
                    'datas' => array(
                        'is_active' => NOTACTIVE
                    ),
                    'conditions' => array(
                        'id' => $this->ion_auth->user()->row()->id,
                    )
                )); 

                $message['is_error'] = false;
                $message['message']  = 'Success cancel request';
            }
        } else {
            $message['is_error'] = true;
            $message['message']  = 'Invalid ID.';
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
    
    /**
     * [submit_login]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_login()
    {     
        //check is ajax request   
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //prepare set data
        $this->form_validation->set_rules('param_mail_name', 'Username Or Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']  = true;
            $message['error_msg'] = trim(strip_tags(validation_errors()));
        } else {
            
            $data = $this->input->post();

            $identity = $data['param_mail_name'];
            $password = $data['password'];
            $remember = isset($data['remember_me']) ? TRUE : FALSE;
            // print_r($this->input->post());
            if( $this->ion_auth->login($identity, $password, $remember)) {
                $message['is_error']  = false;
                $message['title_msg']   = 'Success !!!';
                $message['success_msg'] = 'Login';
                $message['redirect']  = site_url('member/personal-data');
            }
            else {
                $message['is_error']    = true;
                $message['error_msg']   = 'Username Or Password do not match';
                $message['redirect']    = '';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submitRegister]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_register()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get all parameter post
        $data = $this->input->post();

        // start validation
        $this->form_validation->set_rules('birth_date', 'Birth Date', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|numeric|required|max_length[20]');
        //special validation
        $this->form_validation->set_rules("username", "Username", "is_unique[users.username]", array(
            "is_unique" => "This username is already exists!"
        ));
        $this->form_validation->set_rules("email", "Email", "is_unique[users.email]", array(
            "is_unique" => "This email is already exists!"
        ));
        $this->form_validation->set_rules("nik", "NIK", "is_unique[users.nik]", array(
            "is_unique" => "This nik is already exists!"
        ));
        // end validation
        // 
        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']  = true;
            $message['error_msg'] = trim(strip_tags(validation_errors()));
        } else {
            
            $additional_data = array(
                'username'      => $data['username'],
                'phone'         => $data['phone'],
                'gender'        => $data['gender'],
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'birth_date'    => date('Y-m-d', strtotime($data['birth_date'])),
                'nik'           => $data['nik'],
                'status'        => 0,
                'type'          => 5,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => 0
            );
            // print_r($this->input->post());die;
            $result = $this->ion_auth->register($data['email'], $data['password'], $data['email'], $additional_data);

            if($result) {
                $message['is_error']    = false;
                $message['title_msg']   = 'Success';
                $message['success_msg'] = 'Registration';
                $message['redirect']    = site_url('login');
            } else {
                $message['is_error']  = true;
                $message['error_msg'] = 'Internal server error';
                $message['redirect']  = '';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submit_profile]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_profile()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get all parameter post
        $data = $this->input->post();

        $this->form_validation->set_rules("email", "Email", "is_unique[users.email]", array(
            "is_unique" => "This email is already exists!"
        ));

        // if( $this->form->validation->)
        if( $data ) {

            $this->db->trans_begin();
            //prepare save db
            $_save_data = array(
                'username'      => $data['username'],
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'gender'        => $data['gender'],
                'birth_date'    => date('Y-m-d',strtotime($data['birth_date'])),
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'nik'           => $data['nik']
            );

            //create name file upload
            $filename = $this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
            // check  upload file
            if(isset($_FILES['img_thum'])){
                $upload_image = $this->upload_file(
                    "img_thum", 
                    $filename, 
                    false,
                    "assets/images/profile",
                    $data['id']
                );
            }
            // print_r($this->input->post());die();
            // if upload file then insert to db
            if(!empty($upload_image)) {
                $_save_data['img_thum'] = $upload_image['filename'];
            }

            //get data
            $get_data = $this->Global_model->set_model('users','u','id')->mode(array(
                'type' => 'single_row',
                'conditions' => array(
                    'id' => $this->ion_auth->user()->row()->id
                )
            ));

            //check file is exist
            if(!empty($upload_image) && isset($get_data['img_thum']) && !empty($get_data['img_thum'])) {
                unlink( 'assets/images/profile/'.$get_data['img_thum']);
            }

            $result = $this->Global_model->set_model('users','u','id')->mode(array(
                'type'  => 'update',
                'datas' => $_save_data,
                'conditions' => array(
                    'id' => $this->ion_auth->user()->row()->id
                )
            ));

            if($this->db->trans_status() == false ) {
                //balikin jangan di insert
                $this->db->trans_rollback();
                $message['is_error']    = true;
                $message['success_msg'] = 'Database operation failed';
            } else {
                $this->db->trans_commit();
                //success
                $message['is_error']    = false;
                $message['success_msg'] = 'Update Data';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }   

    /**
     * [submit_dokumen]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_dokumen()
    {
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get parameter id
        $id = $this->input->post('id');    

        //create name file upload
        $filename_ktp        = "KTP_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        $filename_ktp_selfie = "KTP_SELFIE_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        $filename_npwp       = "NPWP_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        $filename_siup       = "SIUP_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        $filename_akta       = "AKTA_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        $filename_sk         = "SK_".$this->ion_auth->user()->row()->username."_".date('Ymd')."_".time();
        //begin transaction
        $this->db->trans_begin();
        // check  upload file
        if(isset($_FILES['scktp'])){
            $upload_ktp = $this->upload_file(
                "scktp", 
                $filename_ktp, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        if(isset($_FILES['scselfie'])){
            $upload_ktp_selfie = $this->upload_file(
                "scselfie", 
                $filename_ktp_selfie, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        if(isset($_FILES['scnpwp'])){
            $upload_npwp= $this->upload_file(
                "scnpwp", 
                $filename_npwp, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        if(isset($_FILES['scsiup'])){
            $upload_siup = $this->upload_file(
                "scsiup", 
                $filename_siup, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        if(isset($_FILES['scakta'])){
            $upload_akta = $this->upload_file(
                "scakta", 
                $filename_akta, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        if(isset($_FILES['scsk'])){
            $upload_sk = $this->upload_file(
                "scsk", 
                $filename_sk, 
                false,
                "assets/file_upload/",
                $id
            );
        }

        // if upload file then insert to db
        if(!empty($upload_ktp)) {
            $_save_data['scan_ktp'] = $upload_ktp['filename'];
        } 

        if(!empty($upload_ktp_selfie)) {
            $_save_data['scan_selfie'] = $upload_ktp_selfie['filename'];
        } 

        if(!empty($upload_npwp)) {
            $_save_data['scan_npwp'] = $upload_npwp['filename'];
        } 

        if(!empty($upload_siup)) {
            $_save_data['scan_siup'] = $upload_siup['filename'];
        } 

        if(!empty($upload_sk)) {
            $_save_data['scan_sk'] = $upload_sk['filename'];
        } 

        if(!empty($upload_akta)) {
            $_save_data['scan_akta'] = $upload_akta['filename'];
        } 
        // print_r($id);die();
        // check id
        if( empty($id ) ) {

            $_save_data['user_id'] = $this->ion_auth->user()->row()->id;
            $_save_data['created_at'] = date('Y-m-d H:i:s');
            $_save_data['updated_at'] = date('Y-m-d H:i:s');

            $this->db->insert('users_document',$_save_data);
            // print_r($this->input->post());die;
            // $result = $this->Global_model->set_model('users_document','ud','id')->mode(array(
            //     'type'  => 'insert',
            //     'datas' => $_save_data
            // ));

            if($this->db->trans_status() == false ) {
                //balikin jangan di insert
                $this->db->trans_rollback();
                $message['is_error']    = true;
                $message['error_msg']   = 'Database operation failed';
            } else {
                $this->db->trans_commit();
                //success
                $message['is_error']    = false;
                $message['success_msg'] = 'Succes upload and update document';
            }
        } else {
            $_save_data['user_id'] = $this->ion_auth->user()->row()->id;
            $_save_data['created_at'] = date('Y-m-d H:i:s');
            $_save_data['updated_at'] = date('Y-m-d H:i:s');
            //get data document
            $get_document = $this->Global_model->set_model('users_document','ud','id')->mode(array(
                'type' => 'all_data',
                'conditions' => array(
                    'ud.user_id' => $this->ion_auth->user()->row()->id
                )
            ));

            if( !empty($get_document) ) {

                // remove document in path
                foreach($get_document as $key => $rows )
                {
                    if(!empty($upload_ktp) & isset($rows['scan_ktp']) && !empty($rows['scan_ktp'])) {
                        unlink('assets/file_upload/'.$rows['scan_ktp']);
                    }

                    if(!empty($upload_ktp_selfie) & isset($rows['scan_selfie']) && !empty($rows['scan_selfie'])) {
                        unlink('assets/file_upload/'.$rows['scan_selfie']);
                    }

                    if(!empty($upload_npwp) & isset($rows['scan_npwp']) && !empty($rows['scan_npwp'])) {
                        unlink('assets/file_upload/'.$rows['scan_npwp']);
                    }

                    if(!empty($upload_siup) & isset($rows['scan_siup']) && !empty($rows['scan_siup'])) {
                        unlink('assets/file_upload/'.$rows['scan_siup']);
                    }

                    if(!empty($upload_akta) & isset($rows['scan_akta']) && !empty($rows['scan_akta'])) {
                        unlink('assets/file_upload/'.$rows['scan_akta']);
                    }

                    if(!empty($upload_sk) & isset($rows['scan_sk']) && !empty($rows['scan_sk'])) {
                        unlink('assets/file_upload/'.$rows['scan_sk']);
                    }
                }
            }
            $result = $this->Global_model->set_model('users_document','ud','id')->mode(array(
                'type'  => 'update',
                'datas' => $_save_data,
                'conditions' => array(
                    'id' => $id
                )
            ));

            if($this->db->trans_status() == false ) {
                //balikin jangan di insert
                $this->db->trans_rollback();
                $message['is_error']    = true;
                $message['error_msg']   = 'Database operation failed';
            } else {
                $this->db->trans_commit();
                //success
                $message['is_error']    = false;
                $message['success_msg'] = 'Succes upload and update document';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submit_mitra]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_mitra()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get all parameter post
        $data = $this->input->post();
        $id   = $data['id'];

        // start validation
        $this->form_validation->set_rules('brand', 'Brand', 'trim|required');
        $this->form_validation->set_rules('phone_no', 'Phone Number', 'trim|numeric|required|max_length[20]');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|numeric|required|max_length[20]');
        // end validation
        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']  = true;
            $message['error_msg'] = trim(strip_tags(validation_errors()));
        } else {
            
            $this->db->trans_begin();

            $_save_data = array(
                'brand'         => $data['brand'],
                'mitra_name'    => $data['mitra_name'],
                'owner'         => $data['owner'],
                'phone_no'      => $data['phone_no'],
                'mobile_no'     => $data['mobile_no'],
                'address'       => $data['address'],
                'sub_district'  => $data['sub_district'],
                'province'      => $data['province'],
                'city'          => $data['city'],
                'email'         => $data['email'],
                'website'       => $data['website'],
                'postal_code'   => $data['postal_code'],
            );

            $filename         = "LOGO_".$data['mitra_name']."_".date('Ymd')."_".time();

            // check  upload file
            if(isset($_FILES['logo'])){
                $upload = $this->upload_file(
                    "logo", 
                    $filename, 
                    false,
                    "assets/file_upload/logo_mitra/",
                    $id
                );
            }

            if(!empty($upload)) {
                $_save_data['logo'] = $upload['filename'];
            } 

            if( $id == "" ) {
                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');

                $result = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
                    'type'  => 'insert',
                    'datas' => $_save_data
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success add data';
                    $message['redirect_to']     = '';
                }
            } else {

                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');
                //get data document
                $get_logo = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
                    'type' => 'single_row',
                    'conditions' => array(
                        'um.id' => $id
                    )
                ));

                if(!empty($upload_ktp) & isset($get_logo['logo']) && !empty($get_logo['logo'])) {
                    unlink('assets/file_upload/logo_mitra/'.$get_logo['logo']);
                }
                // print_r($this->input->post());die();
                $result = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
                    'type'  => 'update',
                    'datas' => $_save_data,
                    'conditions' => array(
                        'id' => $id
                    )
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success update data';
                    $message['redirect_to']     = '';
                }
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submit_mitra]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_rekening()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get all parameter post
        $data = $this->input->post();
        $id   = $data['id'];

        // start validation
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'trim|required');
        $this->form_validation->set_rules('bank_account', 'No. Rekening', 'trim|required');
        $this->form_validation->set_rules('bank_user', 'Atas Nama', 'trim|required');
        // end validation
        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']  = true;
            $message['error_msg'] = trim(strip_tags(validation_errors()));
        } else {
            
            $this->db->trans_begin();

            $_save_data = array(
                'bank_name'       => $data['bank_name'],
                'bank_account'    => $data['bank_account'],
                'bank_user'       => $data['bank_user'],
            );

            if( $id == "" ) {
                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');

                $result = $this->Global_model->set_model('users_bank','ub','bank_id')->mode(array(
                    'type'  => 'insert',
                    'datas' => $_save_data
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success add data';
                    $message['redirect_to']     = '';
                }
            } else {

                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');

                // print_r($this->input->post());die();
                $result = $this->Global_model->set_model('users_bank','ub','bank_id')->mode(array(
                    'type'  => 'update',
                    'datas' => $_save_data,
                    'conditions' => array(
                        'bank_id' => $id
                    )
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success update data';
                    $message['redirect_to']     = '';
                }
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submit_mitra]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
    public function submit_kontak()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        //get all parameter post
        $data = $this->input->post();
        $id   = $data['id'];

        // start validation
        $this->form_validation->set_rules('name', 'Nama Bank', 'trim|required');
        // end validation
        if ($this->form_validation->run() === FALSE)
        {
            $message['is_error']  = true;
            $message['error_msg'] = trim(strip_tags(validation_errors()));
        } else {
            
            $this->db->trans_begin();

            $_save_data = array(
                'name'          => $data['name'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'mobile'        => $data['mobile'],
                'name_ops'      => $data['name_ops'],
                'email_ops'     => $data['email_ops'],
                'phone_ops'     => $data['phone_ops'],
                'mobile_ops'    => $data['mobile_ops']
            );

            if( $id == "" ) {
                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');

                $result = $this->Global_model->set_model('users_contact','uc','contact_id')->mode(array(
                    'type'  => 'insert',
                    'datas' => $_save_data
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success add data';
                    $message['redirect_to']     = '';
                }
            } else {

                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['created_at']   = date('Y-m-d H:i:s');
                $_save_data['updated_at']   = date('Y-m-d H:i:s');

                // print_r($this->input->post());die();
                $result = $this->Global_model->set_model('users_contact','uc','contact_id')->mode(array(
                    'type'  => 'update',
                    'datas' => $_save_data,
                    'conditions' => array(
                        'contact_id' => $id
                    )
                ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success update data';
                    $message['redirect_to']     = '';
                }
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [generate_nda_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function submit_buyer() 
    {

        //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }
        
        $this->load->model(array(
            'M_member',
            'Global_model'
        ));

        //initial.
        $message['is_error'] = true;
        $message['error_msg'] = "";
        $message['redirect_to'] = "";

        //sanitize input (id is primary key, if from edit, it has value).
        $id     = $this->input->post('id');
        $data   = $this->input->post();

        //server side validation.
        $this->_set_rule_validation();

        //checking.
        if ($this->form_validation->run($this) == FALSE) {

            //validation failed.
            $message['error_msg'] = validation_errors();
        } else {

            //begin transaction
            $this->db->trans_begin();
            //validation success
            //prepare save to DB
            
            $get_mitra_info = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
                'type' => 'single_row',
                'conditions' => array(
                    'user_id' => $this->ion_auth->user()->row()->id
                ),
                'return_object' => true
            ));

            $check_buyer_api = $this->Global_model->set_model('users_requestv2','um','id')->mode(array(
                'type' => 'single_row',
                'conditions' => array(
                    'user_id' => $this->ion_auth->user()->row()->id,
                    'buyer_type' => API,
                    'status_request >'  => 0 
                ),
                'return_object' => true
            ));

            $check_buyer_whitelabel = $this->Global_model->set_model('users_requestv2','um','id')->mode(array(
                'type' => 'single_row',
                'conditions' => array(
                    'user_id' => $this->ion_auth->user()->row()->id,
                    'buyer_type' => WHITELABEL,
                    'status_request >'  => 0 
                ),
                'return_object' => true
            ));

            $check_buyer_ta = $this->Global_model->set_model('users_requestv2','um','id')->mode(array(
                'type' => 'single_row',
                'conditions' => array(
                    'user_id' => $this->ion_auth->user()->row()->id,
                    'buyer_type' => TRAVELAGENT,
                    'status_request >'  => 0 
                ),
                'return_object' => true
            ));

     
            //cek type buyer
            if( $data['buyer_type'] == API ) {

                if($check_buyer_api) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Anda sudah request sebelumnya sebagai buyer (API)";
                    $message['redirect_to'] = "";

                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } elseif(empty($get_mitra_info)) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Silahkan isi informasi mitra";
                    $message['redirect_to'] = "";

                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else {
                    //prepare save data
                    $mitra_name = ($get_mitra_info->mitra_name) ? $get_mitra_info->mitra_name : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";
                    $telp       = ($get_mitra_info->phone_no) ? $get_mitra_info->phone_no : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";
                    $_save_data = array(
                        'request_date'          => NOW,
                        'title'                 => '',
                        'name'                  => '',
                        'company'               => $mitra_name,
                        'telephone'             => $telp,
                        'email'                 => $email,
                        'ip_dev_1'              => $data['ip_dev_1'],
                        'ip_dev_2'              => $data['ip_dev_2'],
                        'ip_production'         => $data['ip_production'],
                        'protocols'             => $data['protocols'],
                        'ports'                 => $data['ports'],
                        'remark'                => $data['remark'],
                        'agree_nda_check'       => $data['agree_nda_check'],
                        'agree_ip_whitelist'    => $data['agree_ip_whitelist'],
                        'change_request'        => $data['change_request'],
                    );

                    //rename file pdf
                    $file_name_nda = $mitra_name.'_'.date('d-m-Y')."_NDA_".time();
                    $file_name_nda = str_replace(" ", "_", $file_name_nda);

                    $file_name_ip = $mitra_name.'_'.date('d-m-Y')."_IP_".time();
                    $file_name_ip = str_replace(" ", "_", $file_name_ip);
                    //set convert form to pdf
                    $pdf_nda = $this->generate_nda_pdf($file_name_nda);
                    $pdf_ip  = $this->generate_ip_pdf($file_name_ip);


                    //get doc pdf exist
                    $get_doc_pdf = $this->Global_model->set_model('users_document_det','ud','doc_id')->mode(array(
                            'type' => 'all_data',
                            'conditions' => array(
                                'user_id'       => $this->ion_auth->user()->row()->id,
                                'request_type'  => BUYER_API,
                                'is_active'     => ACTIVE
                            )
                    ));

                    //if you have ever requested and canceled it, delete the existing file 
                    if(!empty($get_doc_pdf)) {

                        foreach($get_doc_pdf as $key => $rows )
                        {
                            if(!empty($pdf_nda) && !empty($pdf_ip) && isset($rows['doc_name']) && !empty($rows['doc_name'])) {
                                unlink('assets/generate_pdf/'.$rows['doc_name']);
                            }
                        }
                    }

                    //prepare insert to tbl users_document_det
                    $insert_doc_nda = $this->M_member->insert('users_document_det', array(
                        'doc_name'      => $pdf_nda['nama_file'],
                        'created_date'  => NOW,
                        'modified_date' => NOW,
                        'user_id'       => $this->ion_auth->user()->row()->id,
                        'request_type'  => BUYER_API
                    ));

                    $insert_doc_ip = $this->M_member->insert('users_document_det', array(
                        'doc_name'      => $pdf_ip['nama_file'],
                        'created_date'  => NOW,
                        'modified_date' => NOW,
                        'user_id'       => $this->ion_auth->user()->row()->id,
                        'request_type'  => BUYER_API
                    ));

                    // $_save_data['user_doc_id'] = $insert_doc_nda;
                    
                    if($data['change_request'] == TEMPORARY) {
                        $_save_data['temp_start_date'] = date('Y-m-d',strtotime($data['temp_start_date']));
                        $_save_data['temp_end_date']   = date('Y-m-d',strtotime($data['temp_end_date']));
                    } 
                }
                
            } else if($data['buyer_type'] == WHITELABEL) {
                if($check_buyer_whitelabel) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Anda sudah request sebelumnya sebagai buyer (WHITELABEL)";
                    $message['redirect_to'] = "";

                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else if(empty($get_mitra_info)) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Silahkan isi informasi mitra";
                    $message['redirect_to'] = "";

                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else {
                    $mitra_name = ($get_mitra_info->mitra_name) ? $get_mitra_info->mitra_name : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";
                    $telp       = ($get_mitra_info->phone_no) ? $get_mitra_info->phone_no : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";


                    $file_name_wl = $mitra_name.'_'.date('d-m-Y')."_WHITE_LABEL_".time();
                    $file_name_wl = str_replace(" ", "_", $file_name_wl);

                    $pdf_wl = $this->generate_whitelabel_pdf($file_name_wl);

                    $get_doc_pdf = $this->Global_model->set_model('users_document_det','ud','doc_id')->mode(array(
                            'type' => 'single_row',
                            'conditions' => array(
                                'user_id'       => $this->ion_auth->user()->row()->id,
                                'request_type'  => BUYER_WHITELABEL,
                                'is_active'     => ACTIVE
                            )
                    ));

                    if(!empty($pdf_wl) && isset($get_doc_pdf['doc_name']) && !empty($get_doc_pdf['doc_name'])) {
                        unlink('assets/generate_pdf/'.$get_doc_pdf['doc_name']);
                    }

                    $this->M_member->insert('users_document_det', array(
                        'doc_name'      => $pdf_wl['nama_file'],
                        'created_date'  => NOW,
                        'modified_date' => NOW,
                        'user_id'       => $this->ion_auth->user()->row()->id,
                        'request_type'  => 22
                    ));

                }
            } else {
                if($check_buyer_ta) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Anda sudah request sebelumnya sebagai buyer (TRAVELAGENT)";
                    $message['redirect_to'] = "";
                    
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else if(empty($get_mitra_info)) {
                    $message['is_error']    = true;
                    $message['error_msg']   = "Tidak bisa melakukan request, Silahkan isi informasi mitra";
                    $message['redirect_to'] = "";

                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;

                } else {
                    $mitra_name = ($get_mitra_info->mitra_name) ? $get_mitra_info->mitra_name : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";
                    $telp       = ($get_mitra_info->phone_no) ? $get_mitra_info->phone_no : "";
                    $email      = ($get_mitra_info->email) ? $get_mitra_info->email : "";

                    $file_name_ta = $mitra_name.'_'.date('d-m-Y')."_TRAVEL_AGENT_".time();
                    $file_name_ta = str_replace(" ", "_", $file_name_ta);

                    $pdf_ta = $this->generate_ta_pdf($file_name_ta);

                    $get_doc_pdf = $this->Global_model->set_model('users_document_det','ud','doc_id')->mode(array(
                            'type' => 'single_row',
                            'conditions' => array(
                                'user_id'       => $this->ion_auth->user()->row()->id,
                                'request_type'  => BUYER_TRAVELAGENT,
                                'is_active'     => ACTIVE
                            )
                    ));

                    if(!empty($pdf_ta) && isset($get_doc_pdf['doc_name']) && !empty($get_doc_pdf['doc_name'])) {
                        unlink('assets/generate_pdf/'.$get_doc_pdf['doc_name']);
                    }

                    $this->M_member->insert('users_document_det', array(
                        'doc_name'      => $pdf_ta['nama_file'],
                        'created_date'  => NOW,
                        'modified_date' => NOW,
                        'user_id'       => $this->ion_auth->user()->row()->id,
                        'request_type'  => 23
                    ));
                }
            }

            // print_r($this->input->post());die();
            //insert or update?
            if ($id == "") {

                //save table request
                $_save_data_request = array(
                    'type'                  => BUYER,
                    'buyer_type'            => $data['buyer_type'],
                    'user_id'               => $this->ion_auth->user()->row()->id,
                    'agree_policy_check'    => $data['agree_policy_check_buyer'],
                    'status_request'        => REQUESTED,
                    'request_date'          => NOW,
                    'created_at'            => NOW,
                    'updated_at'            => NOW
                );

                $request_id = $this->M_member->insert('users_requestv2', $_save_data_request);

                $_save_data['request_id']   = $request_id;
                $_save_data['user_id']      = $this->ion_auth->user()->row()->id;
                $_save_data['request_date'] = NOW;
                $_save_data['created_at']   = NOW; 
                $_save_data['updated_at']   = NOW; 

                if( $data['buyer_type'] == API ) {
                    $result = $this->M_member->insert('users_buyer',$_save_data);
                }
                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['notif_title']     = 'Success!';
                    $message['notif_message']   = 'Request has been submited';
                    $message['redirect_to']     = site_url();
                }
            } else {

                //end transaction.
                // if ($this->db->trans_status() === FALSE) {
                //     $this->db->trans_rollback();
                //     $message['error_msg'] = 'Insert failed! Please try again.';
                // } else {
                //     $this->db->trans_commit();
                //     //growler.
                //     $message['is_error'] = false;
                //     $message['notif_title'] = "Excellent!";
                //     $message['notif_message'] = "Article has been updated.";

                //     //on update, redirect.
                //     $message['redirect_to'] = site_url('manager/article/');
                // }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [submit_seller]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [void] 
     */
    public function submit_seller()
    {
        //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }
        
        $this->load->model(array(
            'M_member',
            'Global_model'
        ));

        //initial.
        $message['is_error'] = true;
        $message['error_msg'] = "";
        $message['redirect_to'] = "";

        //get all parameter input
        $data       = $this->input->post();
        $request_id = array();

        //get mitra info
        $get_mitra_info = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $this->ion_auth->user()->row()->id
            ),
            'return_object' => true
        ));

        //get doc info
        $get_doc_info = $this->Global_model->set_model('users_document','ud','id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $this->ion_auth->user()->row()->id
            ),
            'return_object' => true
        ));

        //get contact info
        $get_contact_info = $this->Global_model->set_model('users_contact','uc','contact_id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $this->ion_auth->user()->row()->id
            ),
            'return_object' => true
        ));

        //get bank info
        $get_bank_info = $this->Global_model->set_model('users_bank','ub','bank_id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $this->ion_auth->user()->row()->id
            ),
            'return_object' => true
        ));

        //check request
        $check_request = $this->Global_model->set_model('users_requestv2','ur','id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'ur.user_id'        => $this->ion_auth->user()->row()->id,
                'type'              => SELLER,
                'status_request >'  => 0 
            )
        ));

        $this->form_validation->set_rules('agree_policy_check_seller','Privacy policy and disclaimer','required');

        if($this->form_validation->run() == FALSE) {
            $message['is_error']    = true;
            $message['error_msg']   = validation_errors();
        } else {
            if( empty($get_mitra_info) ) {
                $message['is_error']    = true;
                $message['error_msg']   = "Tidak bisa melakukan request isi terlebih dahulu informasi mitra";
                
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit();
            } elseif( empty($get_doc_info) ) {
                $message['is_error']    = true;
                $message['error_msg']   = "Tidak bisa melakukan request silahkan upload document terlebih dahulu";
            } elseif( empty($get_contact_info) ) {
                $message['is_error']    = true;
                $message['error_msg']   = "Tidak bisa melakukan request silahkan isi kontak informasi terlebih dahulu ";

                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit();
            } elseif( empty($get_bank_info) ) {
                $message['is_error']    = true;
                $message['error_msg']   = "Tidak bisa melakukan request silahkan isi informasi rekening bank terlebih dahulu ";

                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit();
            } else if( !empty($check_request)) {
                $message['is_error']    = true;
                $message['error_msg']   = "Tidak bisa melakukan request, Anda sudah melakukan request sebagai seller sebelumnya";

                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit();
            } else {

                $this->db->trans_begin();
                
                if( $data['id_seller'] == "" ) {

                    //get existing doc
                    $get_doc_pdf = $this->Global_model->set_model('users_document_det','ud','doc_id')->mode(array(
                        'type' => 'single_row',
                        'conditions' => array(
                            'user_id'       => $this->ion_auth->user()->row()->id,
                            'request_type'  => SELLER,
                            'is_active'     => 1
                        )
                    ));

                    //prepare save data
                    $_save_data_request = array(
                        'type'                  => SELLER,
                        'user_id'               => $this->ion_auth->user()->row()->id,
                        'agree_policy_check'    => $data['agree_policy_check_seller'],
                        'status_request'        => REQUESTED,
                        'request_date'          => NOW,
                        'created_at'            => NOW,
                        'updated_at'            => NOW
                    );

                    //remove doc existing
                    if( !empty($get_doc_pdf) ) {
                        $update = $this->Global_model->set_model('users_document_det','ud','doc_id')->mode(array(
                            'type' => 'update',
                            'datas' => array(
                                'is_active' => 0
                            ),
                            'conditions' => array(
                                'user_id'       => $this->ion_auth->user()->row()->id,
                                'request_type'  => SELLER,
                                'is_active'     => 1
                            )
                        ));
                    }

                    $request_id = $this->M_member->insert('users_requestv2', $_save_data_request);
                    $file_name_seller = $get_mitra_info->mitra_name.'_'.date('d-m-Y')."_SELLER_".time();
                    $file_name_seller = str_replace(" ", "_", $file_name_seller);

                    $pdf_seller  = $this->generate_seller_pdf($file_name_seller);

                    if(!empty($pdf_seller) && isset($get_doc_pdf['doc_name']) && !empty($get_doc_pdf['doc_name'])) {
                        unlink('assets/generate_pdf/'.$get_doc_pdf['doc_name']);
                        print_r(error_get_last());
                    }

                    $this->M_member->insert('users_document_det', array(
                        'doc_name'      => $pdf_seller['nama_file'],
                        'created_date'  => NOW,
                        'modified_date' => NOW,
                        'user_id'       => $this->ion_auth->user()->row()->id,
                        'request_type'  => 1
                    ));
                    
                    if($this->db->trans_status() == false ) {
                        //balikin jangan di insert
                        $this->db->trans_rollback();
                        $message['is_error']        = true;
                        $message['error_msg']       = 'Database operation failed!';
                    } else {
                        $this->db->trans_commit();
                        //success
                        $message['is_error']        = false;
                        $message['success_msg']     = 'Request has been submited';
                        $message['redirect_to']     = '';
                    }
                }
            }
        }
        
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }


    /**
     * [generate_nda_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function generate_nda_pdf($filename = '')
    {
        $this->load->model('Global_model');
        $data['mitra'] = $this->Global_model->set_model('users_mitra','um','id')->mode(array(
            'type' => 'single_row',
            'conditions' => array(
                'user_id' => $this->ion_auth->user()->row()->id
            )
        ));

        $html = $this->load->view('generate_pdf_nda',$data,true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $output = $dompdf->output();

        $direktori = 'assets/generate_pdf/';

        if(!is_dir($direktori)) {
            mkdir($direktori, 0777, TRUE);
        }

        file_put_contents($direktori.$filename.'.pdf', $output);

        return array(
            'nama_file' => $filename.'.pdf'
        );
    }

    /**
     * [generate_ip_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function generate_ip_pdf($filename = '')
    {
        $this->load->model('Global_model');

        $data['ip_whitelist'] = $this->Global_model->set_model('users_buyer','ub','id')->mode(array(
            'type' => 'single_row',
            'select' => 'ub.*, um.mitra_name,um.brand,u.first_name,u.last_name',
            'joined' => array(
                'users_mitra um' => array(
                    'um.user_id' => 'ub.user_id'
                ),
                'users u' => array(
                    'u.id' => 'um.user_id'
                )
            ),
            'conditions' => array(
                'ub.user_id' => $this->ion_auth->user()->row()->id
            )
        ));

        $html = $this->load->view('generate_pdf_ip',$data,true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $output = $dompdf->output();

        $direktori = 'assets/generate_pdf/';

        if(!is_dir($direktori)) {
            mkdir($direktori, 0777, TRUE);
        }

        file_put_contents($direktori.$filename.'.pdf', $output);

        return array(
            'nama_file' => $filename.'.pdf'
        );
    }

    /**
     * [generate_ip_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function generate_seller_pdf($filename = '')
    {
        $this->load->model('Global_model');
        $data['seller'] = $this->Global_model->set_model('users','u','id')->mode(array(
            'type' => 'single_row',
            'select' => 
                    'u.*, 
                    um.email as email_mitra,
                    um.mitra_name,
                    um.owner,
                    um.phone_no,
                    um.mobile_no,
                    um.address,
                    um.city,
                    um.province,
                    um.website,
                    uc.name as name_contact,
                    uc.email as email_contact,
                    uc.phone as phone_contact,
                    uc.mobile,
                    uc.name_ops,
                    uc.email_ops,
                    uc.phone_ops,
                    uc.mobile_ops,
                    ub.*',
            'left_joined' => array(
                'users_mitra um' => array(
                    'um.user_id' => 'u.id'
                ),
                'users_contact uc' => array(
                    'u.id' => 'uc.user_id'
                ),
                'users_bank ub' => array(
                    'ub.user_id' => 'u.id'
                )
            ),
            'conditions' => array(
                'u.id' => $this->ion_auth->user()->row()->id
            ),
            'debug_query' => false
        ));

        $html = $this->load->view('generate_pdf_seller',$data,true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $output = $dompdf->output();

        $direktori = 'assets/generate_pdf/';

        if(!is_dir($direktori)) {
            mkdir($direktori, 0777, TRUE);
        }

        file_put_contents($direktori.$filename.'.pdf', $output);

        return array(
            'nama_file' => $filename.'.pdf'
        );
    }

    /**
     * [generate_ip_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function generate_whitelabel_pdf($filename = '')
    {
        $this->load->model('Global_model');
        $data['whitelabel'] = $this->Global_model->set_model('users','u','id')->mode(array(
            'type' => 'single_row',
            'select' => 
                    'u.*, 
                    um.email as email_mitra,
                    um.mitra_name,
                    um.owner,
                    um.phone_no,
                    um.mobile_no,
                    um.address,
                    um.city,
                    um.province,
                    um.website,
                    uc.name as name_contact,
                    uc.email as email_contact,
                    uc.phone as phone_contact,
                    uc.mobile,
                    uc.name_ops,
                    uc.email_ops,
                    uc.phone_ops,
                    uc.mobile_ops,
                    ub.*',
            'left_joined' => array(
                'users_mitra um' => array(
                    'um.user_id' => 'u.id'
                ),
                'users_contact uc' => array(
                    'u.id' => 'uc.user_id'
                ),
                'users_bank ub' => array(
                    'ub.user_id' => 'u.id'
                )
            ),
            'conditions' => array(
                'u.id' => $this->ion_auth->user()->row()->id
            ),
            'debug_query' => false
        ));

        $html = $this->load->view('generate_pdf_whitelabel',$data,true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $output = $dompdf->output();

        $direktori = 'assets/generate_pdf/';

        if(!is_dir($direktori)) {
            mkdir($direktori, 0777, TRUE);
        }

        file_put_contents($direktori.$filename.'.pdf', $output);

        return array(
            'nama_file' => $filename.'.pdf'
        );
    }

    /**
     * [generate_ta_pdf with domppdf]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [filename] 
     */
    public function generate_ta_pdf($filename = '')
    {
        $this->load->model('Global_model');
        $data['travel_agent'] = $this->Global_model->set_model('users','u','id')->mode(array(
            'type' => 'single_row',
            'select' => 
                    'u.*, 
                    um.email as email_mitra,
                    um.mitra_name,
                    um.owner,
                    um.phone_no,
                    um.mobile_no,
                    um.address,
                    um.city,
                    um.province,
                    um.website,
                    uc.name as name_contact,
                    uc.email as email_contact,
                    uc.phone as phone_contact,
                    uc.mobile,
                    uc.name_ops,
                    uc.email_ops,
                    uc.phone_ops,
                    uc.mobile_ops,
                    ub.*',
            'left_joined' => array(
                'users_mitra um' => array(
                    'um.user_id' => 'u.id'
                ),
                'users_contact uc' => array(
                    'u.id' => 'uc.user_id'
                ),
                'users_bank ub' => array(
                    'ub.user_id' => 'u.id'
                )
            ),
            'conditions' => array(
                'u.id' => $this->ion_auth->user()->row()->id
            ),
            'debug_query' => false
        ));

        $html = $this->load->view('generate_pdf_ta',$data,true);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $output = $dompdf->output();

        $direktori = 'assets/generate_pdf/';

        if(!is_dir($direktori)) {
            mkdir($direktori, 0777, TRUE);
        }

        file_put_contents($direktori.$filename.'.pdf', $output);

        return array(
            'nama_file' => $filename.'.pdf'
        );
    }

    public function example()
    {

        $this->load->model('Global_model');
        $data['ip_whitelist'] = $this->Global_model->set_model('users_buyer','ub','id')->mode(array(
            'type' => 'single_row',
            'select' => 'ub.*, um.mitra_name,um.brand,u.first_name,u.last_name',
            'joined' => array(
                'users_mitra um' => array(
                    'um.user_id' => 'ub.user_id'
                ),
                'users u' => array(
                    'u.id' => 'um.user_id'
                )
            ),
            'conditions' => array(
                'ub.user_id' => $this->ion_auth->user()->row()->id
            )
        ));


        // print_r($data['seller']);die();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('generate_pdf_ip', $data);
    }

    /**
     * [get_city]
     * @author didi <[diditriawan13@gmail.com]>
     * @return [json] 
     */
    public function get_city()
    {

        $id_province    = $this->input->post('id');
        $data           = $this->Global_model->set_model('mst_regencies','mr','id')->mode(array(
            'type' => 'all_data',
            'conditions' => array(
                'mr.province_id' => $id_province
            ),
            'return_object' => true
        ));

        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }


    /**
     * Get data for Select2 bound
     * @author [didi triawan] <[<diditriawan13@gmail.com>]>
     * @return [JSON] [get list of kecamatan]
     */
    public function list_kecamatan()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        //get ajax query and page.
        $select_q    = ($this->input->get("q") != null) ? trim($this->input->get("q")) : "";
        $select_page = ($this->input->get("page") != null) ? trim($this->input->get("page")) : 1;
        $kab_id      = ($this->input->get("kab_id") != null) ? trim($this->input->get("kab_id")) : 0;

        //sanitazion.
        $select_q = $select_q;

        //page must numeric.
        $select_page = ($select_page) ? $select_page : 1;

        //for paging, calculate start.
        $limit = 10;
        $start = ($limit * ($select_page - 1));

        //filters.
        $filters = array();
        if ($select_q != "") {
            $filters["name"] = $select_q;
        }

        //conditions.
        $conditions = array(
            "regency_id" => $kab_id
        );

        //get data.
        $datas = $this->Global_model->set_model('mst_districts','md','id')->mode(array(
            "type"            => "all_data",
            "select"          => array("name as id", "name as text"),
            "conditions"      => $conditions,
            "filter"          => $filters,
            "limit"           => $limit,
            "start"           => $start,
            "return_object"   => true,
            "debug_query"     => false
        ));

        $this->output->set_content_type('application/json');
        echo json_encode($datas);
        exit;
    }

    /**
     * [upload_file]
     * @author didi <[diditriawan13@gmail.com]>
     * @param   string $[key] [<post off name>]
     *          string $file_name [<file name>] 
     *          bool $multiple [<true or false>] 
     *          mix  $multipleupload_path [<path position>] 
     *          int  $id 
     * @return [array] 
     */
    protected function upload_file ($key, $file_name, $multiple = false, $upload_path, $id) {
        $message['is_error'] = true;
        $message['error_msg'] = "";
        $message['redirect_to'] = "";

        //load the uploader library.
        $this->load->library('Uploader');

        $config = array(
            "allowed_types"         =>  FILE_TYPE_UPLOAD,
            "file_ext_tolower"      =>  true,
            "overwrite"             =>  false,
            "max_size"              =>  MAX_UPLOAD_FILE_SIZE_IN_KB,
            "upload_path"           =>  $upload_path,
        );

        if (!empty($file_name)) {
            $config['filename_overwrite'] = $file_name;
        }

        //try to upload the image.
        $upload_result = $this->uploader->upload_files($key, $multiple, $config);

        if ($upload_result['is_error']) {
            if ($upload_result['is_error']) {
                if (($id == "" && $upload_result['result'][0]['error_code'] == 0) || $upload_result['result'][0]['error_code'] != 0) {
                    //file upload error of something.
                    //show the error.
                    $message['error_msg'] = $upload_result['result'][0]['error_msg'];

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                }

            }
        }

        return $upload_result['result'];
    }
}