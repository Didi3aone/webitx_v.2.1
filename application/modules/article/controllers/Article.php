<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MX_Controller {

	private $_view = 'article/';
    protected $data;
    protected $data_header;
    protected $data_footer;

    public function __construct()
    {
        parent::__construct();
        // load constructor
        $this->load->library(array(
            'form_validation', 'general','ion_auth'
        ));

        $this->load->model(['m_general','Article_model']);
        $this->general->saveVisitor($this, [1, 0]);
        $this->data = array();
        $this->data_header = array();
        $this->data_footer = array();
    }

    /**
     * [index ui article]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
	public function index()
	{
        $this->load->library('pagination');
		$this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Blog';
        $this->data_header['breadcrumb_child'] = 'Event And News';

        $total_rows = $this->Article_model->count_all_data();
       
        $config['base_url']     = site_url('article/index'); //site url
        $config['total_rows']   =  $total_rows;//total row
        $config['enable_query_strings'] = TRUE;
        $config['per_page']     = 5;  //show record per halaman
        $config["uri_segment"]  = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        $this->pagination->initialize($config);
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        
        $data['limit']  = $config['per_page']; 
        $data['offset'] = $offset;
       
        $this->data['data'] = $this->Article_model->get_all_data($data);
        $this->data['pagination'] = $this->pagination->create_links();

        $this->data_footer['view_js'] = array();

        $this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'index', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
	}


    /**
     * [index ui single_blog]
     * @author didi <[diditriawan13@gmail.com]>
     * @return void
     */
	public function read($seo_url) 
	{
		$this->data_header['is_breadcrumb']    = 'block';
        $this->data_header['breadcrumb']       = 'Blog';
        $this->data_header['breadcrumb_child'] = 'Event And News';
        //
        $this->data['data'] = $this->Article_model->get_all_data(array(
            'seo_url' => $seo_url
        ));

        // print_r($this->data);die;

		$this->load->view(LAYOUT_FRONTEND_HEADER, $this->data_header, FALSE);
        $this->load->view($this->_view.'single-article', $this->data, FALSE);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $this->data_footer, FALSE);
	}
	// end 
	
}

/* End of file Article.php */
/* Location: ./application/modules/article/controllers/Article.php */