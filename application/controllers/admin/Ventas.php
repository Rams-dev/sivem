<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('EspectacularesModel');
		$this->load->model('ClientesModel');
		$this->load->model('VentasModel');
		$this->load->model('MediosModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){

		// $this->load->view('template/__head');
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/ventas/ventas');
		$this->load->view('admin/templates/__footer');

	//	$this->load->view('template/__footer');
		}else{
			redirect('login');
		}
		
    }
    
    public function agregarVenta(){
        if($this->session->userdata('is_logged')){
            $data['clientes'] =  $this->ClientesModel->obtenerClientes();

            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/ventas/agregarVenta', $data);
            $this->load->view('admin/templates/__footer');
    
        }else{
            redirect('login');
        }
    }

    function obtenerMediosDisponibles($medio){
        if($this->session->userdata('is_logged')){
                $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($medio);
                echo json_encode($mediosDisponibles);

        }else{
            redirect('login');
        }
    }

    function obtenerMedioPorId($id_medio){
        if($this->session->userdata('is_logged')){
                $medio = $this->MediosModel->obtenerMediosPorId($id_medio);
                echo json_encode($medio);
        }else{
            redirect('login');
        }

    }

    function guardarVenta(){
        if($this->session->userdata('is_logged')){
        $id_cliente = $this->input->post('cliente');
        $tipoArte = $this->input->post('tipoDeArte');
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaTermino = $this->input->post('fechaTermino');
        $noPagos = $this->input->post('pagos');
        $factura = $this->input->post('factura');
        $tipoPago = $this->input->post('tipoDePago');
        $id_tipoMedio = $this->input->post('tipoMedio');
        // if($id_tipoMedio == '1'){
        //     $tipoMedio = 'espectaculares';
        // }elseif($id_tipoMedio == '2'){
        //     $tipoMedio = 'vallas fijas';
        // }else{
        //     $tipoMedio = 'vallas moviles';
        // }
        // $medio = $this->input->post('medio');
        $monto = $this->input->post('monto');
        $fecha_venta =  date('Y-m-d h:i:s');
        $idsMedios =explode(',',$this->input->post("idmedios")); 
         $formData=$this->input->post();
        // for($m = 0; $m < count($idsMedios); $m++){
            //  echo json_encode($fecha_venta);
        // }
        //     echo json_encode($formData);
        // echo json_encode(array('error'=>' venta exitosa'));
            // exit;

        if(!$sql = $this->VentasModel->agregarVenta($id_cliente,$monto,$fecha_venta,$factura)){
            echo json_encode(array('error' => 'error, intentalo mas tarde.'));
        }
        //var_dump($sql);
        for($m = 0; $m < count($idsMedios); $m++){
            if(!$query = $this->VentasModel->agregarVentaMedio($sql,$idsMedios[$m],$noPagos,$tipoPago,$fechaInicio,$fechaTermino,$tipoArte)){
                echo json_encode(array('error'=> 'error, intentalo mas tarde.'));
                $this->VentasModel->eliminarVenta($sql);
            }else{
                echo json_encode(array('success'=>' venta exitosa'));
                $this->MediosModel->cambiarStatusMedio($idsMedios[$m]);
            }
        }
        // echo json_encode(array($id_cliente,$tipoArte,$fechaInicio,$fechaTermino,$noPagos,$factura,$tipoPago,$tipoMedio,$medio,$fecha_venta, $monto));

    }else{
        redirect('login');
    }
    }
}