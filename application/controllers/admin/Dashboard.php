<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('MediosModel');
		$this->load->model('VentasModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
			$date = date("Y-m-d");
			$apartados = $this->VentasModel->obtenerVenta_mediosPorFechaInicio($date);
			if(count($apartados)>0){
				for($i=0; $i<count($apartados); $i++){
					$this->MediosModel->cambiarStatusApartadoAOcupado($apartados[$i]["id_medio"]);		
				}
			}

			$ocupados = $this->VentasModel->obtenerVenta_mediosPorFechaTermino($date);
			if(count($ocupados)>0){
				for($o=0; $o<count($ocupados); $o++){
					$this->MediosModel->cambiarStatusOcupadoADisponible($ocupados[$o]["id_medio"]);		
				}
			}

			$mediosOcupados = $this->MediosModel->obtenerMediosOcupadosSinFechadeInicio($date);
			if(count($mediosOcupados)>0){
				for($m=0; $m<count($mediosOcupados); $m++){
					$this->MediosModel->CambiarOcupadoADisponible($mediosOcupados[$m]["id"]);
				}
			}
			
			$mediosApartados = $this->MediosModel->obtenerMediosApartadosSinVenta($date);
			if(count($mediosApartados)>0){
				for($mA=0; $mA<count($mediosApartados); $mA++){
					$this->MediosModel->CambiarApartadoAOcupado($mediosApartados[$mA]["id"]);
				}
			}

			// var_dump($mediosOcupados);



			// var_dump($apartados);

			$this->load->view('admin/templates/__head');
			$this->load->view('admin/templates/__nav');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
		
	}

}