<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
//		$this->load->model('Menus');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){

		// $this->load->view('template/__head');
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/templates/__footer');

	//	$this->load->view('template/__footer');
		}else{
			redirect('login');
		}
		
	}
}