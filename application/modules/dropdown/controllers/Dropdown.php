<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dropdown extends MX_Controller {

	public function provinsi($selected = '')
	{
		$get = $this->Global_model->set_model('mst_provinces','mp','id')->mode(array(
			'type' => 'all_data',
			'return_object' => true
		));
		return options($get, 'name', $selected, 'name');
	}

	public function kabupaten($selected = '')
	{
		$get = $this->Global_model->set_model('mst_regencies','mr','id')->mode(array(
			'type' => 'all_data',
			'return_object' => true
		));
		return options($get, 'name', $selected, 'name');
	}

	public function kecamatan($selected = '')
	{
		$get = $this->Global_model->set_model('mst_districts','md','id')->mode(array(
			'type' => 'all_data',
			'return_object' => true
		));
		return options($get, 'name', $selected, 'name','id');
	}
}