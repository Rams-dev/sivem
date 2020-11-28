<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MediosModel');
		$this->load->model('ClientesModel');
		$this->load->model('EspectacularesModel');
		$this->load->model('Vallas_fijasModel');

	}
	public function index()
	{

		if($this->session->userdata('is_logged')){
		// $data['medios'] = $this->MediosModel->obtenerMedios();
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
		// $datos = $this->MediosModel->obtenerMedios();
		$espectaculares = $this->EspectacularesModel->obtenerEspectaculares();
		$vallas_fijas = $this->Vallas_fijasModel->obtenerVallas_fijas();
		$datos = array_merge($espectaculares,$vallas_fijas);
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
			$municipio = $this->input->post("municipio");
			//   echo json_encode(array($id_estado, $status,$tipo_medio));
			//  exit;

		
			if($id_estado == "" && $municipio == "" && $status == "" && $tipo_medio == "" ){
				$espectaculares = $this->EspectacularesModel->obtenerEspectaculares();
				$vallas_fijas = $this->Vallas_fijasModel->obtenerVallas_fijas();
				// var_dump($vallas_fijas);
				$datos = array_merge($espectaculares,$vallas_fijas);
			}
			else{
				if(!$datos = $this->MediosModel->getMediosHttp($id_estado,$municipio,$status,$tipo_medio)){
					echo json_encode("error");
					exit;
				}else{
				
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
			$espectaculares = $this->EspectacularesModel->obtenerEspectaculares();
				$vallas_fijas = $this->Vallas_fijasModel->obtenerVallas_fijas();
				// var_dump($vallas_fijas);
				$data["medios"] = array_merge($espectaculares,$vallas_fijas);
		}else{
			if(!$datos = $this->MediosModel->getMediosHttp($estado,$status,$medio)){
				echo json_encode("error");
				exit;
			}else{
				$data['medios'] = $datos;			
			}
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