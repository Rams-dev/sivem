<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiales extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		 $this->load->model('MaterialesModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
		$data['materiales']= $this->MaterialesModel->obtenerMateriales();
			
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/materiales/materiales', $data);
		$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
	}

	public function agregarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$nombre = $this->input->post('nombrematerial');
			$precio = $this->input->post('preciomaterial');
			$observacion = $this->input->post('observacionmaterial');

			if(!$datos = $this->MaterialesModel->agregarMaterial($nombre,$precio,$observacion)){
				echo json_encode(array("error" => "Error al insertar los datos"));
			}else{
				echo json_encode(array("success" =>"Material agregago correctamente"));
			}
			
		}else{
			redirect('login');
		}
	}

	public function obtenerMaterialPorId($id){
		if($this->session->userdata('is_logged')){
			if($data = $this->MaterialesModel->obtenerMaterialPorId($id)){
				echo json_encode($data);
			}else{
				echo json_encode(array("error" => "Ocurrio un error"));
			}
		}else{
			redirect("login");
		}
	}

	public function editarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$id = $this->input->post();
			echo json_encode($id);
			// if(!$datos = $this->MaterialesModel->agregarMaterial($nombre,$precio,$observacion)){
			// 	echo json_encode("error");
			// }else{
			// 	echo json_encode("Material agregago correctamente");
			// }
			
		}else{
			redirect('login');
		}
	}

	public function eliminarMaterial()
	{
		if($this->session->userdata('is_logged')){
			$id = $this->input->post();
			// echo json_encode($id);
			if(!$datos = $this->MaterialesModel->eliminarMaterial($id['id'])){
				echo json_encode(array("error" => "Error al eliminar el material"));
			}else{
			 	echo json_encode(array("success" => "Material Eliminado correctamente"));
			}
			
		}else{
			redirect('login');
		}
	}



	
}