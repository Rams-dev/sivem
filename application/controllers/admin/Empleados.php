<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('EmpleadosModel');
		$this->load->model('ClientesModel');

	}
	public function index()
	{
        
		if($this->session->userdata('is_logged')){
		$data['empleados'] = $this->EmpleadosModel->obtenerEmpleados();
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/empleados/empleados',$data);
		$this->load->view('admin/templates/__footer');

		}else{
			redirect('login');
		}
		
	}
	
	function agregarEmpleado(){
		if($this->session->userdata('is_logged')){
			$nombre = $this->input->post("nombre");
			$apellidos = $this->input->post("apellidos");
			$correo = $this->input->post("correo");
			$puesto = $this->input->post("puesto");
			$sexo = $this->input->post("sexo");
			$telefono = intval(join("",explode("-",$this->input->post("telefono"))));
			$accesso = $this->input->post("acceso");
			if($accesso == "si"){
				$contrasenia = $this->input->post("contrasenia");
				$tipo = $this->input->post("tipo");
			}else{
				$contrasenia = "";
				$tipo = "";
			}


			// echo json_encode(array($nombre,$apellidos,$contrasenia,$correo,$puesto,$sexo,$telefono,$tipo,$accesso));
			// exit;
			if($this->EmpleadosModel->agregarEmpleado($nombre,$apellidos,$contrasenia,$correo,$puesto,$sexo,$telefono,$tipo,$accesso)){
				echo json_encode(array("success" => "Empleado agregado correctamente"));
			}else{
				echo json_encode(array("error" => "Ha ocurrido un error, intenta mas tarde"));
			}
		}else{
			redirect("login");

		}

	}

	function EliminarEmpleado(){
		if($this->session->userdata('is_logged')){

		$id_empledo = $this->input->post();
		// echo json_encode($id_empledo); 

		if(!$query = $this->EmpleadosModel->EliminarEmpleado($id_empledo['id'])){
			echo json_encode(array("error" => "El empleado no se pudo eliminar, intenta más tarde"));
		}else{
			echo json_encode(array("success" => "Empleado eliminado correctamente"));
		}

		}else{
			redirect("login");
		}
	}

	function getEmpleadoPoId($id){
		if($this->session->userdata('is_logged')){
			if($data = $this->EmpleadosModel->obtenerEmpleadoPoId($id)){
				echo json_encode($data);
			}else{
				echo json_encode("Sin resultados");

			}
		}else{
			redirect("login");
		}


	}

	

	function editaEmpleado(){
		if($this->session->userdata("is_logged")){
			$id = $this->input->post("id");
			$nombre = $this->input->post("Enombre");
			$apellidos = $this->input->post("Eapellidos");
			$correo = $this->input->post("Ecorreo");
			$puesto = $this->input->post("Epuesto");
			$sexo = $this->input->post("Esexo");
			$telefono = intval(join("",explode("-",$this->input->post("Etelefono"))));
			$accesso = $this->input->post("Eacceso");
			if($accesso == "si"){
				$contrasenia = $this->input->post("Econtrasenia");
				$tipo = $this->input->post("Etipo");
			}else{
				$contrasenia = "";
				$tipo = "";
			}

			if($this->EmpleadosModel->editarEmpleado($id,$nombre,$apellidos,$contrasenia,$correo,$puesto,$sexo,$telefono,$tipo,$accesso)){
				echo json_encode(array("success" => "Empleado editado correctamente"));
			}else{
				echo json_encode(array("error" => "Ha ocurrido un error, intenta mas tarde"));
			}


			//  $formData = $this->input->post();
			//  echo json_encode($formData);



		}else{
			redirect("login");
		}
	}

}