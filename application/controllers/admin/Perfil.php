<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('EmpleadosModel');

	}
	public function index()
	{
        
		if($this->session->userdata('is_logged')){
         $data['usuario'] = $this->EmpleadosModel->obtenerEmpleadoPoId($this->session->userdata("id"));
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/perfil/perfil',$data);
		$this->load->view('admin/templates/__footer');

		}else{
			redirect('login');
		}
		
	}
	
	public function guargarDatosEditados(){
		if($this->session->userdata('is_logged')){
			$id = $this->session->userdata("id");
			$nombre = $this->input->post("nombre");
			$apellidos = $this->input->post("apellidos");
			$contrasena = $this->input->post("contrasena");
			$correo = $this->input->post("correo");
			$puesto = $this->input->post("puesto");
			$sexo = $this->input->post("sexo");
			$telefono = $this->input->post("telefono");
//		echo json_encode($formData);

			if(!$data = $this->EmpleadosModel->actualizarUsuario($id,$nombre,$apellidos,$contrasena,$correo,$puesto,$sexo,$telefono)){
				echo json_encode(array("error" => "No se pudo actualizar la información"));
			}else{
				echo json_encode(array("success" => "Perfil editado con éxito"));
			}
		   }else{
			   redirect('login');
		   }
		   

	}
}