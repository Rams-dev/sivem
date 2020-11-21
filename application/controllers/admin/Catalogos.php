<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MediosModel');
		$this->load->model('ClientesModel');
		$this->load->model('EspectacularesModel');

	}
	public function index()
	{

		if($this->session->userdata('is_logged')){
		$data['medios'] = $this->MediosModel->obtenerMedios();
		$data['estados'] = $this->Models->obtenerEstados();
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/catalogos/catalogos',$data);
		$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
	}

	public function obtenerDatosDeCatalogos(){
		$datos = $this->MediosModel->obtenerMedios();
		echo json_encode($datos);
	}   


	public function obtenerMedios(){
		if($this->session->userdata('is_logged')){

			// $id_estado = $this->input->post();
			// echo json_encode($id_estado);
			// exit;


			$id_estado = $this->input->post('estado');
			$status = $this->input->post('status');
			$tipo_medio = $this->input->post('tipomedio');
			//   echo json_encode(array($id_estado, $status,$tipo_medio));
			//  exit;

		
			if($id_estado == "" && $status == "" && $tipo_medio == "" ){
				$datos = $this->MediosModel->obtenerMedios();
			}else{
				if(!$datos = $this->MediosModel->getMediosHttp($id_estado,$status,$tipo_medio)){
					echo json_encode("error");
					exit;
				}

			}
			
			
			echo json_encode($datos);
		}else{
			redirect('login');
		}
	}
   
   
   public function catalogoPdf(){
		if($this->session->userdata('is_logged')){

		$estado = $this->input->post("estado");
		$status = $this->input->post("status");
		$medio = $this->input->post("tipomedio");
		
		if($estado == "" && $status == "" && $medio == ""){
			$data["medios"] = $this->MediosModel->obtenerMedios();
		}else{
			$data["medios"] = $this->MediosModel->getMediosHttp($estado,$status,$medio);
		}
			// echo json_encode($data);
        $html=$this->load->view('admin/catalogos/catalogoespectacularesPDF',$data);
		// echo $html;
		$this->Models->generatePdf($html);
		}else{
			redirect('login');
		}
	}
	
	
}