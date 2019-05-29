<?php

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
    }

    public function index()
    {
        $this->general->saveVisitor($this, [2, 0]);
        if ($this->ion_auth->is_admin())
            redirect(base_url('adminpanel/dashboard'));

        $data['MasterGeneral']         = $this->m_get->getRowDynamic([
            'select'    => 'favicon, logo',
            'from'      => 'v2_master_landingpage',
            'where'     => [
                'id' => 1
            ]
        ]);
        $this->load->view('adminpanel/template/login', $data);
    }

    public function registerXX()
    {
        die();
        // $this->ion_auth->delete_user(5);
        $FirstName      = "Admin";
        $LastName       = "";
        $Username       = "4M1n0pS1b00k";
        $Password       = "4M1n0pS1b00k2018";
        $Phone          = "";
        $Email          = "";

        $AdditionalData = array(
            'first_name'    => $FirstName,
            'last_name'     => $LastName,
            'Phone'         => $Phone,
            'status'        => 1,
            'type'          => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'created_by'    => 0
        );
    
        $this->ion_auth->register($Username, $Password, $Email, $AdditionalData);
    }
    
    public function logout()
    {
        $this->general->saveVisitor($this, [2, 1]);
        // log the user out
        $logout = $this->ion_auth->logout();
        // redirect them to the landing page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect(base_url('adminpanel/login'), 'refresh');
    }

    public function checkLogin()
    {
        $this->general->saveVisitor($this, [2, 1]);
        $input = $this->general->filtering_datas($this->input->post());
        // echo "<pre>";
        // print_r($input);

        if (!isset($input['username']) || !isset($input['password'])) {
            $this->session->set_flashdata('AdmPanelLoginError', 'Invalid Username Or Password');
            redirect(base_url('adminpanel/login'));
        }

        if ($input) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->session->set_flashdata('AdmPanelLoginError', trim(strip_tags(validation_errors())));
                redirect(base_url('adminpanel/login'));
            }
            else
            {
                $identity = $input['username'];
                $password = $input['password'];
                // echo $this->ion_auth->hash_password_db('4', '4M1n0pS1b00k2018');
                // print_r( $this->ion_auth->login($identity, $password, FALSE, 'admin') );
                // die();
                if($this->ion_auth->login($identity, $password, FALSE)) {
                    // if not admin
                    if (!$this->ion_auth->is_admin()) {
                        $this->session->set_flashdata('AdmPanelLoginError', strip_tags('Not Allowed'));
                    redirect(base_url('adminpanel/login'));
                    }
                    // redirect them to the member dashboard page
                    redirect(base_url('adminpanel/dashboard'));
                }
                else {
                    // print_r($this->ion_auth->errors());
                    $this->session->set_flashdata('AdmPanelLoginError', strip_tags($this->ion_auth->errors()));
                    redirect(base_url('adminpanel/login'));
                }
            }
        }


    }

}

?>