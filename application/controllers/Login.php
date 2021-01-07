<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('LoginModel');
		$this->load->helper(array('rules'));
	}
	
	public function index()
	{
		$this->load->view('login');
		
	}
	public function validate(){
		$this->form_validation->set_error_delimiters('','');
		$rules =  getLoginRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run()===FALSE){
			$errors = array(
				'correo' => form_error('correo'),
				'contrasena' => form_error('contrasena')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
		}else{
			$correo = $this->input->post('correo');
			$password = $this->input->post('contrasena');
			if(!$datos = $this->LoginModel->validation($correo,$password)){
				echo json_encode(array('mensaje' => 'usuario o contraseña incorrectos'));
				$this->output->set_status_header(401);
				exit;
			}
	
			$data= array(
				'id' => $datos->id,
				'nombre' => $datos->nombre,
				'apellidos' => $datos->apellidos,
				'correo' => $datos->correo,
				'tipo' => $datos->tipo,
				'is_logged' => TRUE,
			);
			if($data['tipo'] == '1' || $data['tipo'] == '2' ){
				$this->session->set_userdata($data);
				echo json_encode(array("url" => base_url('admin/dashboard')));
			}

		}

	}


	public function logout(){
		$vars = array('id','tipo','nombre','apellidos','correo','is_logged');
		$this->session->unset_userdata($vars);
		$this->session->sess_destroy();
		redirect('login');
	}

}
