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
            $data['ventas'] = $this->VentasModel->obtenerVentas();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/ventas/ventas',$data);
            $this->load->view('admin/templates/__footer');
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

    function obtenerMedios($id_medio){
        if($this->session->userdata('is_logged')){
            
                // $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
                $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($id_medio);
                $mediosApartados = $this->MediosModel->obtenerMediosApartados($id_medio);
                //$mediosReservados = $this->MediosModel->obtenerMediosReservados($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
                // $medios = array();
                // for($i =0; $i<count($mediosDisponibles); $i++){
                //     for($j =0; $j<count($mediosApartados); $j++){
                //         if($mediosApartados[$j]['id_medio'] == $mediosDisponibles[$i]['id_medio']){
                //             unset($mediosDisponibles[$j]['id_medio'])
                //             array_push($medios)
                //         }
                //     }
                // }
                $medios = array_merge($mediosDisponibles, $mediosApartados);

                echo json_encode($medios);
                //echo json_encode($mediosReservados);

        }else{
            redirect('login');
        }
    }

    public function verificarDisponibilidad(){
        $data = $this->input->post();
        $ventasMedios = $this->VentasModel->obtenerVentasPorIdMedio($data['medio']);
        // var_dump(count($ventasMedios));
        $fi = $data['fechaInicio']; 
        $ft = $data['fechaTermino']; 
        for($i = 0; $i<count($ventasMedios); $i++){
            if($ventasMedios[$i]['fecha_inicio_contrato'] > $fi and $ventasMedios[$i]['fecha_inicio_contrato'] > $ft or $ventasMedios[$i]['fecha_termino_contrato'] <$fi and $ventasMedios[$i]['fecha_termino_contrato'] < $ft ){
            }else{
                echo json_encode(array("error" => "Este medio estará ocupado durante fechas seleccionadas" ));
                exit;
            }

            
        }
    //     $data = $this->input->post();
    //     if($data['medio'] == '1'){
    //         $espectacular = $this->EspectacularesModel->
            
    //     }
    //     $mediosReservados = $this->MediosModel->verificarDisponibilidad($data['medio'],$data['fechaInicio'],$data['fechaTermino']);
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
        $descuentoPocentaje = $this->input->post('descuentoCantidad');
        $descuentoPrecio = $this->input->post('descuento');
        $precio_final= $this->input->post('precio_final');
//         echo json_encode(array('success'=>' venta exitosa'));
// exit;

        //  $formData=$this->input->post();
        //  echo json_encode(array($id_cliente,$tipoArte,$fechaInicio,$fechaTermino,$noPagos,$factura,$tipoPago,$id_tipoMedio,$monto,$fecha_venta,$idsMedios,$descuentoPocentaje,$descuentoPrecio,$precio_final));
        //  exit;
        // for($m = 0; $m < count($idsMedios); $m++){
            //  echo json_encode($fecha_venta);
        // }
        //     echo json_encode($formData);
        // echo json_encode(array('error'=>' venta exitosa'));
            // exit;

        if(!$sql = $this->VentasModel->agregarVenta($id_cliente,$monto,$descuentoPocentaje, $descuentoPrecio, $precio_final,$fecha_venta,$factura)){
            echo json_encode(array('error' => 'error, intentalo mas tarde.'));
        }
        //var_dump($sql);
        for($m = 0; $m < count($idsMedios); $m++){
            if(!$query = $this->VentasModel->agregarVentaMedio($sql,$idsMedios[$m],$noPagos,$tipoPago,$fechaInicio,$fechaTermino,$tipoArte)){
                echo json_encode(array('error'=> 'error, intentalo mas tarde.'));
                $this->VentasModel->eliminarVenta($sql);
            }else{
                $medioG = $this->MediosModel->cambiarStatusMedio($idsMedios[$m]);
            }
        }
        if($medioG){
            echo json_encode(array('success'=>' venta exitosa'));
        }else{
            echo json_encode(array('error'=>'no se pudo realizar la venta, intenta mas tarde'));


        }
        // echo json_encode(array($id_cliente,$tipoArte,$fechaInicio,$fechaTermino,$noPagos,$factura,$tipoPago,$tipoMedio,$medio,$fecha_venta, $monto));

    }else{
        redirect('login');
    }
    }
}