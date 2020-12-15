<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MediosModel');
		$this->load->model('Vallas_movilesModel');
		
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
		$vallas_moviles = $this->Vallas_movilesModel->obtenerVallas_moviles();
		// $datos = $espectaculares = $vallas_moviles + $vallas_fijas;
		$datos = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);

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
				$vallas_moviles = $this->Vallas_movilesModel->obtenerVallas_moviles();
				// var_dump($vallas_moviles);
				// $datos = $espectaculares = $vallas_fijas + $vallas_moviles; 
				$datos = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
			}
			else{
				if(!$datos = $this->MediosModel->getMediosHttp($id_estado,$municipio,$status,$tipo_medio)){
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
		$medio = $this->input->post("tipoMedio");
		$municipio = $this->input->post("municipio");
		// var_dump($status,$estado,$medio,$municipio);
		// exit;
		
		if($estado == "" && $status == "" && $medio == "" && $municipio == ""){
			$espectaculares = $this->EspectacularesModel->obtenerEspectaculares();
			$vallas_fijas = $this->Vallas_fijasModel->obtenerVallas_fijas();
			$vallas_moviles = $this->Vallas_movilesModel->obtenerVallas_moviles();

				// var_dump($vallas_fijas);
				$datos = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
				$data['medios'] = $datos;
		}else{
			if(!$m = $this->MediosModel->getMediosHttp($estado,$municipio,$status,$medio)){
				echo json_encode("error");
				exit;
			}else{
				$data['medios'] = $m;
			}
		}
		// $data['medios'] = $datos;			
        $html=$this->load->view('admin/catalogos/catalogoespectacularesPDF',$data);
        //$this->load->view('admin/catalogos/catalogoespectacularesPDF',$data);
		//echo $html;
		$this->Models->generatePdf($html);
		}else{
			redirect('login');
		}
	}
	

	// function noControlExiste(){
	// 	$NC = $this->input->post();
	// 	if($data = $this->MediosModel->noControlExiste($NC['nc'])){
	// 		if(count($data)>0){
	// 			echo json_encode("error" => "El número de control ingresado ya existe")
	// 		}
	// 	}
	// }
	
}