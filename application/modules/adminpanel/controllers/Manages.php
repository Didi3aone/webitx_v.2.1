<?php

class Manages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'ion_auth', 'form_validation', 'general']);
        $this->general->saveVisitor($this, [2, 0]);
        if ( !$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || $this->ion_auth->user()->result()[0]->type > 4 )
    		redirect(base_url('adminpanel/login/logout'));
        $this->load->model('manages/m_manages');
    }

    /**
     * 
     */
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

    /**
     * 
     */
    public function contactUs()
    {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-edit',
            'LeftMenuTitle'     => 'Contact Us',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/contactUs'],
                ['isUrl' => FALSE,'Name' => 'Contact Us'],
            ]
        ];

        $data = $this->globalFunction($data);
        $data['ContactUsData'] = [];
        $ContactUs = $this->m_manages->getContactUs();
        if ($ContactUs) {
            $data['ContactUsData'] = array_merge( [], (Array) $ContactUs );
            $data['ContactUsData']['ContactCenter'] = json_decode($ContactUs->ContactCenter,true);
            $data['ContactUsData']['ContactCenter2'] = json_decode($ContactUs->TourInquiries,true);
            $data['ContactUsData']['ContactCenter3'] = json_decode($ContactUs->ComplainCompliment, true);
        }
        $this->load->view('adminpanel/manages/contactus/edit', $data);
    }

    /**
     * list article
     */
    public function article()
    {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-book',
            'LeftMenuTitle'     => 'List Article',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/article'],
                ['isUrl' => FALSE,'Name' => 'Article'],
            ]
        ];

        $data = $this->globalFunction($data);

        $data['List']   = array();
        
        $article = $this->Global_model->set_model('mst_article','ma','id')->mode(array(
            'type'      => 'all_data',
            'select'    => 'ma.*, mca.name',
            'joined'    => array(
                // 'mst_article_detail mad' => array('mad.article_id' => 'ma.id'),
                'mst_category_article mca' => array('mca.id' => 'ma.category_id')
            )
        ));

        foreach($article as $key => $row) {
            $art = array(
                'hash_id'  => $row['hash_id'],
                'id'       => $row['id'],
                'title'    => $row['title'],
                'category' => $row['name'],
                'url'      => $row['seo_url'],
                'publish'  => ($row['is_publish'] == 1) ? "Yes" : "NO"
            );

            $data['List'][] = $art;
        }
        
        $this->load->view('adminpanel/manages/article/list', $data);
    }

    /**
     * 
     */
    public function create_article()
    {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-book',
            'LeftMenuTitle'     => 'Create Article',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/article'],
                ['isUrl' => FALSE,'Name' => 'Article'],
            ]
        ];

        $data['kategori'] = $this->Global_model->set_model('mst_category_article','mca','id')->mode(array(
            'type' => "all_data",
        ));

        $data = $this->globalFunction($data);
        $this->load->view('adminpanel/manages/article/create', $data);
    }

    /**
     * 
     */
    public function edit_article( $hash_id )
    {
        $data['HeaderBar'] = [
            'FaName'            => 'fa-book',
            'LeftMenuTitle'     => 'Edit Article',
            'RightMenuTitle'    => [
                ['isUrl' => TRUE, 'Name' => 'Manage', 'Url' => 'manages/article'],
                ['isUrl' => FALSE,'Name' => 'Article'],
            ]
        ];

        //
        $data['kategori'] = $this->Global_model->set_model('mst_category_article','mca','id')->mode(array(
            'type' => "all_data",
        ));

        $data['data'] = $this->Global_model->set_model('mst_article','ma','id')->mode(array(
            'type' => 'single_row',
            'select'    => 'ma.*, ma.id as articleid, mca.name, mca.id',
            'joined'    => array(
                // 'mst_article_detail mad' => array('mad.article_id' => 'ma.id'),
                'mst_category_article mca' => array('mca.id' => 'ma.category_id')
            ),
            'conditions' => array(
                'ma.hash_id' => $hash_id
            ),
        ));

        $data = $this->globalFunction($data);
        $this->load->view('adminpanel/manages/article/create', $data);
    }

    /**
     *  process form ajax
     * @author 
     * @return void
     */
    public function proses_form_article()
    {
        // if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
        //     exit('No direct script access allowed');
        // }

        $this->load->library('form_validation');
        
        //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        $this->form_validation->set_rules('title', 'Title','trim|required');
        $this->form_validation->set_rules('seo_url','Seo Url','required');
        $this->form_validation->set_rules('category_id','Category','required');

        $data = $this->input->post();
        $id   = $this->input->post('id');
        
        if( $this->form_validation->run() == FALSE ) {
            $message['is_error']  = true;
            $message['error_msg'] = validation_errors();
        } else {

            $this->db->trans_begin();

            $_save_data = array(
                'hash_id'           => generate_hash($data['title']),
                'title'             => $data['title'],
                'seo_url'           => $data['seo_url'],
                'category_id'       => $data['category_id'],
                'meta_keywords'     => $data['meta_keywords'],
                'meta_description'  => $data['meta_description'],
                'content'           => $data['content']
            );

            $filename = $data['title']."-".uniqid().time();
            if(isset($_FILES['photo']) ){
                $upload_file = $this->upload_file(
                    "photo", 
                    $filename, 
                    false,
                    "assets/file_upload/article-image/",
                    $id
                );
            }

            // print_r($upload_file['uploaded_path']);die;
            if(!empty($upload_file)) {
                $_save_data['photo_real'] = $upload_file['uploaded_path'];
            }     

            //check if $id null then methode insert
            if( $id == 0 ) {
                // print_r(
                // $this->input->post()
                // );die();
                // save other information
                $_save_data['created_by'] = $this->ion_auth->user()->row()->username;
                $_save_data['created_at'] = date('Y-m-d H:i:s');
                $_save_data['updated_at'] = date('Y-m-d H:i:s');

                $result = $this->Global_model->set_model('mst_article')->mode(array(
                    'type'  => 'insert',
                    'datas' => $_save_data
                ));

                // $this->Global_model->set_model('mst_article_detail')->mode(array(
                //     'type'  => 'insert',
                //     'datas' => array(
                //         'article_id' => $result,
                //         'tag_id'     => ''
                //     )
                // ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'New article has been added !!!';
                    $message['redirect_to']     = site_url('adminpanel/manages/article');
                }
            } else {
                //  print_r(
                // $this->input->post()
                // );die();
                // save other information
                $_save_data['created_at'] = date('Y-m-d H:i:s');
                $_save_data['updated_at'] = date('Y-m-d H:i:s');
                $_save_data['updated_by'] = $_save_data['created_by'] = $this->ion_auth->user()->row()->username;

                //update detail
                $result = $this->Global_model->set_model('mst_article')->mode(array(
                    'type'  => 'update',
                    'datas' => $_save_data,
                    'conditions' => array(
                        'id' => $id
                    )
                ));

                // //update detail
                // $this->Global_model->set_model('mst_article_detail')->mode(array(
                //     'type'  => 'update',
                //     'datas' => array(
                //         'article_id' => $result,
                //         'tag_id'     => ''
                //     ),
                //     'conditions' => array(
                //         'article_id' => $id
                //     )
                // ));

                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                    $message['is_error']        = true;
                    $message['error_msg']       = 'Database operation failed!';
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['success_msg']     = 'Success update article';
                    $message['redirect_to']     = site_url('adminpanel/manages/article');
                }
            }
        }

        //set output json encode
        $this->output->set_content_type('application/json')->set_output(json_encode(
            $message
        ));
        
    }

    /**
     *  delete article ajax
     * @author 
     * @return void
     */
    public function delete_article()
    {   //initials
        $message['is_error']  = true;
        $message['error_msg'] = '';

        $id = $_POST['id'];
        // print_r($this->input->post('id'));die();
       
        if(!empty($id) ) {
            $this->Global_model->set_model('mst_article')->mode(array(
                'type' => 'update',
                'datas' => array(
                    'is_active'  => 0,
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => $this->ion_auth->user()->row()->username
                )
            ));

            //initials
            $message['is_error']    = false;
            $message['success_msg'] = 'Success deleted article';
        } else {
            //initials
            $message['is_error']  = true;
            $message['error_msg'] = 'Invalid ID.';
            $message['id']        = $id;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(
            $message
        ));
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
        //initials 
        $message['is_error'] = true;
        $message['error_msg'] = "";
        $message['redirect_to'] = "";

        //load the uploader library.
        $this->load->library('Uploader');
        
        //config upload path
        //size 
        $config = array(
            "allowed_types"         =>  FILE_TYPE_UPLOAD,
            "file_ext_tolower"      =>  true,
            "overwrite"             =>  false,
            "max_size"              =>  MAX_UPLOAD_FILE_SIZE_IN_KB,
            "upload_path"           =>  $upload_path,
        );

        // check if not empty filename
        // then overwrite filename
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

?>