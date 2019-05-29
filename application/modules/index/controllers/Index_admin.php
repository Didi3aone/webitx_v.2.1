<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * index admin class , manage login,logout,register forgot password
 * project wisata-tour-islam
 * @license [MIT LICENSE]
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link(it-underground.web.id)
 * @since [< version 2.1 > april-2019] [<lts version>]
 */
class Index_admin extends MX_Controller {

	private $_view_folder 	= "index";
	private $_folder_js		= "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
	}

	/**
	 * function index load ui login
	 * @return 
	 */
	public function index()
	{
		$data = array(
			"title_tab" => "CMS-BOOKING"
		);

		$this->render_page('index/login',$data);
	}

	/**
	 * [proses_login]
	 */
	public function proses_login()
	{
		$this->load->library('form_validation');
		//inisisal
		$error_message 	 = "";
		$success_message = "";

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if( $this->form_validation->run() == false )
		{
			$error_message = validation_errors();
		} else {

			$user   = $this->input->post('username');
			$pass   = $this->input->post('password');
			$cookie = $this->input->post('remember');

			$check_login = $this->Global_model->set_model('tm_user','tu','id')->mode(array(
				"type" 			=> "single_row",
				"select"		=> "*",
				"joined"		=> array(
					"tm_user_role tur" => array('tur.id' => 'tu.role_id')
				),
				"conditions" 	=> array(
					"username" => $user
				)
			));

			if(!empty($check_login) && password_verify($pass, $check_login['password'])) {
				$data = $check_login;

				$sess_data = array(
					"IS_LOGIN"  => TRUE,
					"id" 		=> $data['id'],
					"name"		=> $data['username'],
					"fullname" 	=> $data['full_name'],
					"level"    	=> $data['name']
				);

				if( $cookie == 1) {
					$cookie_value = md5('CMSCookie-'.date('YmdHis').'-'.mt_rand(100, 199));
					$days_exp = 30;
					$cookie = array (
						'name' 		=> 'BOOKING',
						'value' 	=> $cookie_value,
						'expire' 	=> $days_exp * 24 * 3600,
					);
					
					$this->input->set_cookie($cookie);
					//update cookie
					$this->Global_model->set_model('tm_user')->mode(array(
						'type'  => UPDATE_DATA,
						'datas' => array(
							'cookie' => $cookie_value
						),
						'conditions' => array(
							'id' => $data['id']
						)
					));
				}

				$this->insert_other_info($data['id']);
				$this->user_activity($data['username']);
				$this->session->set_userdata($sess_data);
				redirect('admin?login(TRUE)&'.URL_HACKED.'&'.URL_ENCODE,'refresh');
			} else {
				$error_message = "Username atau password yang anda masukan salah.";
			}
		}
		$this->session->set_flashdata('error',$error_message);
		redirect('Auth?login(FALSE)&'.URL_HACKED.'&'.URL_ENCODE,'refresh');
	}

	/**
	 * [insert_other_info description]
	 * @param  [int] $user_id [get user_id]
	 * @return [void] true         
	 */
	private function insert_other_info($user_id)
	{
		$this->Global_model->set_model("tm_user")->mode(array(
			"type" 		=> UPDATE_DATA,
			"datas" 	=> array(
				"hash_id"		=> generate_hash(),
				"ip_address" 	=> get_client_ip(),
				"status_login"	=> "LOGIN"
			),
			"conditions" => array(
				"id" => $user_id
			)
		));
	}

	/**
	 * [user_activity save activity user to database]
	 * @param  string $username [get username]
	 */
	private function user_activity($username = "")
	{
		$data = array(
			"username" 				=> $username,
			"userlogin_time"   		=> date('Y-m-d H:i:s'),
			"user_activity"			=> ACTIVITY_LOGIN,
			"activity_date" 		=> date('Y-m-d H:i:s'),
			"user_ip_address"		=> get_client_ip(),
			"user_device"			=> NULL,
			"user_city_activity" 	=> NULL,
			"user_agent"		 	=> NULL
		);

		$this->Global_model->set_model("t_log_activityuser")->mode(array(
			"type" 		=> INSERT_NO_DATE,
			"datas" 	=> $data
		));
	}

	/**
	 * [logout]
	 */
	public function logout()
	{
		$id 		= set_session('id');
		$username   = set_session('name');
		
		$this->Global_model->set_model("tm_user")->mode(array(
			"type"  => UPDATE_DATA,
			"datas" => array(
				"status_login" => "LOGOUT"
			),
			"conditions" => array(
				"id" => $id
			)
		));

		$this->Global_model->set_model("t_log_activityuser")->mode(array(
			"type" 		=> INSERT_NO_DATE,
			"datas" 	=> array(
				"username" 				=> $username,
				"userlogout_time"  		=> date('Y-m-d H:i:s'),
				"user_activity"			=> ACTIVITY_LOGOUT,
				"activity_date" 		=> date('Y-m-d H:i:s'),
				"user_ip_address"		=> get_client_ip(),
				"user_device"			=> NULL,
				"user_city_activity" 	=> NULL,
				"user_agent"		 	=> NULL
			)
		));

		$this->session->sess_destroy();
		redirect('Auth?login(FALSE)&'.URL_HACKED.'&'.URL_ENCODE,'refresh');
	}
}

/* End of file Index_admin.php */
/* Location: ./application/modules/user/controllers/Index_admin.php */