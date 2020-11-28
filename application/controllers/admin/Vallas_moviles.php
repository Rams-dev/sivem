<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vallas_moviles extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MaterialesModel');
		$this->load->model('MediosModel');
		$this->load->model('PropietariosModel');
		$this->load->model('ClientesModel');
        $this->load->model('EspectacularesModel');
        $this->load->model('Vallas_fijasModel');
        

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
            // $data['vallas_fijas'] = $this->Vallas_fijasModel->obtenerVallas_fijas();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_moviles/vallas_moviles');
            $this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
    }

    public function agregarValla_movil(){
        if($this->session->userdata('is_logged')){
            $data['materiales'] = $this->MaterialesModel->obtenerMateriales();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_moviles/agregarValla_movil',$data);
            $this->load->view('admin/templates/__footer');
        }else{
            redirect("login");
        }
    }

    public function guardarValla_movil(){
        if($this->session->userdata('is_logged')){

            $nocontrol = $this->input->post('nocontrol');
            $marca = $this->input->post('marca');
            $modelo = $this->input->post('Modelo');
            $anio = $this->input->post('anio');
            $roadShow = $this->input->post('roadShow');
            $costo = $this->input->post('costo');
            $acabados = $this->input->post('acabados');
            $anchoLateral = $this->input->post('anchoLateral');
            $altoLateral = $this->input->post('altoLateral');
            $materialLateral = $this->input->post('materialLateral');
            $anchoFaldon = $this->input->post('anchoFaldon');
            $altoFaldon = $this->input->post('altoFaldon');
            $materialFaldon = $this->input->post('materialFaldon');
            $anchoER = $this->input->post('anchoER');
            $altoER = $this->input->post('altoER');
            $materialER = $this->input->post('materialER');
            $anchoPuerta = $this->input->post('anchoPuerta');
            $altoPuerta = $this->input->post('altoPuerta');
            $materialPuerta = $this->input->post('materialPuerta');
            $anchoFrente = $this->input->post('anchoFrente');
            $altoFrente = $this->input->post('altoFrente');
            $materialFrente = $this->input->post('materialFrente');
            $anchoFR = $this->input->post('anchoFR');
            $altoFR = $this->input->post('altoFR');
            $materialFR = $this->input->post('materialFR');
            $observaciones = $this->input->post('observaciones');
            $acabados = $this->input->post('acabados');
            echo json_encode(array($nocontrol,$marca,$modelo,$anio,$roadShow,$costo,$acabados,$anchoLateral,$altoLateral,$materialLateral,$anchoFaldon,$altoFaldon,$materialFaldon,$anchoER,$altoER,$materialER,$anchoPuerta,$altoPuerta,$materialPuerta,$anchoFrente,$altoFrente,$materialFrente,$anchoFR,$altoFR,$materialFR,$observaciones,$acabados));

        }else{
            redirect("login");
        }
    }
}