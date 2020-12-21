<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('EspectacularesModel');
		$this->load->model('ClientesModel');
		$this->load->model('VentasModel');
		$this->load->model('MediosModel');
		$this->load->model('EmpleadosModel');
		$this->load->model('Models');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
            $espectaculares = $this->VentasModel->obtenerVentasEspectaculares();
            $vallas_fijas = $this->VentasModel->obtenerVentasVallas_fijas();
            $vallas_moviles = $this->VentasModel->obtenerVentasVallas_moviles();

            $data["ventas"] = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
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

    public function obtenerMedios(){
        if($this->session->userdata('is_logged')){
            $id = $this->input->post("medio");
            $fi = $this->input->post("fechaInicio");
            $ft = $this->input->post("fechaTermino"); 
            // echo json_encode(array($id,$fi,$ft));
            // exit; 
            
            $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($id);
            $mediosApartados = $this->MediosModel->obtenerMediosApartados($id, $fi, $ft);
            $medios = array_merge($mediosDisponibles, $mediosApartados);
            
            echo json_encode($medios);

        }else{
            redirect('login');
        }
    }

    public function obtenerVallasMovilesDisponibles(){
        $h1 = $this->input->post("h1");
        $h2 = $this->input->post("h2");
        $f1 = $this->input->post("f1");
        $f2 = $this->input->post("f2");
        $id = $this->input->post("id");

        $vallas_disponibles = $this->MediosModel->obtenerMediosDisponibles($id);
        $vallas_apartadas_por_fecha = $this->MediosModel->obtenerMediosApartados($id,$f1,$f2);
        $vallas_disponibles_porhorario= $this->MediosModel->obtenerMediosApartadosPorHorario($id,$f1,$f2,$h1,$h2);
        // for($v = 0; $v<count($vallas_apartadas_por_fecha); $v++){
        //      for($v2 = 0; $v2<count($vallas_disponibles_porhorario); $v2++){
        //         if($vallas_apartadas_por_fecha[$v]["id_medio"] == $vallas_disponibles_porhorario[$v2]["id_medio"]){
        //             unset($vallas_disponibles_porhorario[$v2]);
        //         }
        //      }
        // }
        // $vallas = array_merge($vallas_disponibles, $vallas_apartadas_por_fecha, $vallas_disponibles_porhorario);

        

        echo json_encode($vallas_apartadas_por_fecha);
        $vallas = [];
        
    }

    public function obtenerChoferesDisponibles(){
        $h1 = $this->input->post("h1");
        $h2 = $this->input->post("h2");
        $f1 = $this->input->post("f1");
        $f2 = $this->input->post("f2");

        $choferesD = $this->EmpleadosModel->obtenerChoferes();
        $choferes_apartados_por_fecha = $this->EmpleadosModel->obtenerChoferesApartadosPorFecha($f1,$f2);
        $choferes_disponibles_porhorario= $this->EmpleadosModel->obtenerChoferesApartadosPorHorario($f1,$f2,$h1,$h2);
        $choferesDisponibles = array();
        for($i = 0; $i < count($choferesD); $i++){
           for($j = 0; $j < count($choferes_disponibles_porhorario); $j++){
               if($choferesD[$i]["id"] == $choferes_disponibles_porhorario[$j]["id_chofer"]){
                   unset($choferesD[$i]);
               }
            //    else{
            //        array_push($choferesDisponibles, $choferesD[$i] );
            //    }
           } 
        }
        $choferes = array_merge($choferesD, $choferes_apartados_por_fecha, $choferes_disponibles_porhorario);
        echo json_encode($choferes_disponibles_porhorario);
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
     }

    function obtenerMedioPorId($id_medio){
        if($this->session->userdata('is_logged')){
            $infoMedios =  $this->MediosModel->obtenerDatosMedioporId($id_medio);
            if($infoMedios){
            foreach($infoMedios as $info){
                $medio = $this->MediosModel->obtenerMediosPorId($id_medio,$info['tipo_medio']);
            }
            if($medio){
                echo json_encode($medio);
            }
            }else{
                echo json_encode("No hay registros");

            }
             
        }else{
            redirect('login');
        }

    }

    function guardarVenta(){
        if($this->session->userdata('is_logged')){
        $id_cliente = $this->input->post('cliente');
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaTermino = $this->input->post('fechaTermino');
        $noPagos = $this->input->post('pagos');
        $factura = $this->input->post('factura');
        $tipoPago = $this->input->post('tipoDePago');
        $monto = $this->input->post('monto');
        $fecha_venta =  date('Y-m-d h:i:s');
        $idsMedios =explode(',',$this->input->post("idmedios")); 
        $descuentoPocentaje = $this->input->post('descuentoCantidad');
        $descuentoPrecio = $this->input->post('descuento');
        $precio_final= $this->input->post('precio_final');
        $medios = json_decode($this->input->post("medios"));

        if(!$sql = $this->VentasModel->agregarVenta($id_cliente,$monto,$descuentoPocentaje, $descuentoPrecio, $precio_final,$fecha_venta,$factura,$noPagos,$tipoPago)){
            echo json_encode(array('error' => 'error, intentalo mas tarde.'));
        }
        foreach ($medios as $medio) {
            $horai = isset($medio[0]->hInicio) ? $medio[0]->hInicio : ""; 
            $horaf = isset($medio[0]->hTermino) ? $medio[0]->hTermino : ""; 
            $id_chofer = isset($medio[0]->idChofer) ? $medio[0]->idChofer : ""; 
            if(!$query = $this->VentasModel->agregarVentaMedio($sql,$medio[0]->id_medio,$fechaInicio,$fechaTermino,$horai,$horaf,$id_chofer)){
                echo json_encode(array('error'=> 'error, intentalo mas tarde.'));
                $this->VentasModel->eliminarVenta($sql);
            }else{
                $medioG = $this->MediosModel->cambiarStatusMedio($medio[0]->id_medio);
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

    public function generarOrdenDeCompra(){
        $html=$this->load->view('admin/ventas/ordenDeCompra');
        //$this->load->view('admin/catalogos/catalogoespectacularesPDF',$data);
		//echo $html;
		$this->Models->generateOrdenCompra($html);

    }
}