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
            // $espectaculares = $this->VentasModel->obtenerVentasEspectaculares();
            // $vallas_fijas = $this->VentasModel->obtenerVentasVallas_fijas();
            // $vallas_moviles = $this->VentasModel->obtenerVentasVallas_moviles();

            // $data["ventas"] = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
            $data["ventas"] = $this->VentasModel->obtenerVentas();

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
            $mediosConFechaDeOcupacion = $this->MediosModel->obtenerMediosConFechaDeOcupacion($id,$fi, $ft);
            $mediosDisponibles = $this->MediosModel->obtenerMediosDisponibles($id);
            $mediosApartadosYOcupados = $this->MediosModel->obtenerMediosApartados($id, $fi, $ft);
            $medios = array_merge($mediosDisponibles, $mediosApartadosYOcupados, $mediosConFechaDeOcupacion);
            
            echo json_encode($mediosConFechaDeOcupacion);

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
        //  echo json_encode(array($h1,$h2,$f1,$f2,$id));
        //  exit;
        $vallasDisponiblesPorHorario = array();
        $vallasOcupadas = $this->MediosModel->obtenerMediosOcupadosPorFecha($id,$f1,$f2);
        $vallas_disponibles = $this->MediosModel->obtenerMediosDisponibles($id);
        $vallas_apartadas_por_fecha = $this->MediosModel->obtenerMediosApartados($id,$f1,$f2);

        for ($v=0; $v < count($vallasOcupadas) ; $v++) { 
            # code...
            if($vallasOcupadas[$v]["hora_inicio"] > $h1 && $vallasOcupadas[$v]["hora_inicio"] > $h2 || $vallasOcupadas[$v]["hora_termino"] < $h1 && $vallasOcupadas[$v]["hora_termino"] < $h2){
                array_push($vallasDisponiblesPorHorario, $vallasOcupadas[$v]);
            }
        }

        if(count($vallasOcupadas)>0 && count($vallas_apartadas_por_fecha)>0){
            for ($VO=0; $VO < count($vallasOcupadas) ; $VO++) { 
                for ($VA=0; $VA < count($vallas_apartadas_por_fecha) ; $VA++) { 
                    # code...
                    if($vallas_apartadas_por_fecha[$VA]["id_medio"] == $vallasOcupadas[$VO]["id_medio"]){
                        unset($vallasOcupadas[$VO]);
                        unset($vallas_apartadas_por_fecha[$VA]);
                    }
                }
           }
        }
        $vallas = array_merge($vallas_disponibles, $vallas_apartadas_por_fecha, $vallasDisponiblesPorHorario);
        echo json_encode($vallas);
        $vallas = [];
        
    }

    public function obtenerChoferesDisponibles(){
        $h1 = $this->input->post("h1");
        $h2 = $this->input->post("h2");
        $f1 = $this->input->post("f1");
        $f2 = $this->input->post("f2");

        $choferesOcupados = $this->EmpleadosModel->obtenerChoferOcupadoPorFecha($f1,$f2);
        $choferesDisponiblesPorHorario = array();
        for($c = 0; $c< count($choferesOcupados); $c++){
            if($choferesOcupados[$c]["hora_inicio"] > $h1 && $choferesOcupados[$c]["hora_inicio"] > $h2 || $choferesOcupados[$c]["hora_termino"] < $h1 && $choferesOcupados[$c]["hora_termino"] < $h2){
                array_push($choferesDisponiblesPorHorario, $choferesOcupados[$c]);
            }
        }

        $choferes_apartados_por_fecha = $this->EmpleadosModel->obtenerChoferesApartadosPorFecha($f1,$f2);
        $choferesD = $this->EmpleadosModel->obtenerChoferesDis();
        if(count($choferesOcupados)>0 && count($choferes_apartados_por_fecha)>0){
             for ($CO=0; $CO < count($choferesOcupados) ; $CO++) { 
                 for ($CA=0; $CA < count($choferes_apartados_por_fecha) ; $CA++) { 
                     # code...
                     if($choferes_apartados_por_fecha[$CA]["id"] == $choferesOcupados[$CO]["id"]){
                         unset($choferesOcupados[$CO]);
                         unset($choferes_apartados_por_fecha[$CA]);
                     }
                 }
            }
        }
        $choferes = array_merge($choferes_apartados_por_fecha,$choferesDisponiblesPorHorario,$choferesD);
        echo json_encode($choferes);
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

    public function detalles($id){
        if($this->session->userdata("is_logged")){

            $espectaculares = $this->VentasModel->obtenerVentasEspectaculares($id);
            $vallas_fijas = $this->VentasModel->obtenerVentasVallas_fijas($id);
            $vallas_moviles = $this->VentasModel->obtenerVentasVallas_moviles($id);
            $medios = array_merge($espectaculares,$vallas_fijas,$vallas_moviles);
            $ventas = $this->VentasModel->obtenerVentaPorId($id); 
            var_dump($vallas_moviles);
            exit;


            for($v = 0; $v <  count($ventas); $v++){
                for($m = 0; $m <  count($medios); $m++){
                    if($medios[$m]["id_medio"] == $ventas[$v]["id_medio"] ){
                        $ventas[$v]["id_medio"] = $medios[$m];
                    }
                }
            }
            $data["ventas"] = $ventas;
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/ventas/detalles',$data);
            $this->load->view('admin/templates/__footer');

        }else{
            redirect("login");
        }
    }

    public function generarOrdenDeCompra(){
        $html=$this->load->view('admin/ventas/ordenDeCompra');
        //$this->load->view('admin/catalogos/catalogoespectacularesPDF',$data);
		//echo $html;
		$this->Models->generateOrdenCompra($html);

    }
}