<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tupa extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_tupa');
		$this->load->helper('utils');
	}

	public function index()
	{   
		$data['combo_area'] = getAreas();
		$this->load->view('v_tupa', $data);
	}


}