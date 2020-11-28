<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('ClientesModel');

	}
	public function index()
	{
        
		if($this->session->userdata('is_logged')){
        // $data['data'] = $this->ClientesModel->obtenerClientes();
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/perfil/perfil');
		$this->load->view('admin/templates/__footer');

		}else{
			redirect('login');
		}
		
    }
}