<?php
class VentasModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}


	public function obtenerVentas(){
		$this->db->select("usuarios.id, usuarios.nombre as nombre_vendedor, usuarios.apellidos as apellido_vendedor,estados.nombre as nombre_estado, clientes.nombre  as razon_social, clientes.rfc, clientes.nombre_encargado, clientes.puesto, clientes.telefono as telefono_cliente, clientes.correo as correo_cliente, ventas.fecha_venta, ventas.monto_total, ventas.id_venta");
		$this->db->join("clientes","clientes.id = ventas.id_comprador");
		$this->db->join("usuarios","usuarios.id = ventas.id_vendedor");
		$this->db->join("estados","estados.id = clientes.id_estado");
		$sql = $this->db->get("ventas");
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	function obtenerVentasEspectaculares($id_venta){
		$this->db->select("*");
		$this->db->from("ventas");
		$this->db->join("venta_medios", "ventas.id_venta = venta_medios.id_venta");
		$this->db->select("usuarios.id as id_vendedor, usuarios.nombre as chofer");
		$this->db->join("usuarios", "ventas.id_vendedor = usuarios.id");
		$this->db->join("espectaculares", "venta_medios.id_medio = espectaculares.id_medio");
		$this->db->select("estados.nombre as nombre_estado");
		$this->db->join("estados", "espectaculares.id_estado = estados.id");
		$this->db->select("clientes.id as cliente_id, clientes.nombre as comprador, clientes.nombre_encargado, clientes.correo as correo_comprador, clientes.telefono");
		$this->db->join("clientes", "ventas.id_comprador = clientes.id");
		$this->db->join("medios", "venta_medios.id_medio = medios.id");
		$this->db->where("ventas.id_venta",$id_venta);
		$sql = $this->db->get();
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	function obtenerVentasVallas_fijas($id_venta){
		$this->db->select("*");
		$this->db->from("ventas");
		$this->db->join("venta_medios", "ventas.id_venta = venta_medios.id_venta");
		$this->db->select("usuarios.id as id_vendedor, usuarios.nombre as chofer");
		$this->db->join("usuarios", "ventas.id_vendedor = usuarios.id");
		$this->db->join("vallas_fijas", "venta_medios.id_medio = vallas_fijas.id_medio");
		$this->db->select("estados.nombre as nombre_estado");
		$this->db->join("estados", "vallas_fijas.id_estado = estados.id");
		$this->db->select("clientes.id as cliente_id, clientes.nombre as comprador, clientes.nombre_encargado, clientes.correo as correo_comprador, clientes.telefono");
		$this->db->join("clientes", "ventas.id_comprador = clientes.id");
		$this->db->join("medios", "venta_medios.id_medio = medios.id");

		$this->db->where("ventas.id_venta",$id_venta);
		$sql = $this->db->get();
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}


	function obtenerVentasVallas_moviles($id_venta){
		$this->db->select("*");
		$this->db->join("ventas", "ventas.id_venta = venta_medios.id_venta");
		// $this->db->select("usuarios.id as id_vendedor, usuarios.nombre as chofer");
		// $this->db->join("usuarios", "venta_medios.id_chofer = usuarios.id");
		$this->db->join("vallas_moviles", "venta_medios.id_medio = vallas_moviles.id_medio");
		$this->db->select("clientes.id as cliente_id, clientes.nombre as comprador, clientes.nombre_encargado, clientes.correo as correo_comprador, clientes.telefono");
		$this->db->join("clientes", "ventas.id_comprador = clientes.id");
		$this->db->join("medios", "venta_medios.id_medio = medios.id");
		$this->db->where("ventas.id_venta",$id_venta);
		//$this->db->group_by("ventas.id_venta");
		$sql = $this->db->get("venta_medios");
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	public function obtenerVentaPorId($id){
		$this->db->select("*");
		$this->db->join("venta_medios","venta_medios.id_venta = ventas.id_venta");
		$this->db->join("medios","venta_medios.id_medio = medios.id");
		$this->db->select("clientes.nombre as razon_social, rfc, domicilio, colonia, poblacion, nombre_encargado, puesto, telefono, correo ");
		$this->db->join("clientes","clientes.id = ventas.id_comprador");
		$this->db->select("estados.nombre as nombre_estado");
		$this->db->join("estados","estados.id = clientes.id_estado");
		$this->db->where("ventas.id_venta",$id);
		// $this->db->group_by("ventas.id_venta");
		$sql = $this->db->get("ventas");
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	public function obtenerVentasPorIdMedio($id_medio){
		$sql =$this->db->get_where("venta_medios",array("id_medio" =>$id_medio));	
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}

	}

	public function agregarVenta($id_cliente,$monto,$descuentoPocentaje,$descuentoPrecio,$precio_final,$fecha_venta,$factura,$noPagos,$tipoPago){
		$data= array(
			'id_vendedor' => $this->session->userdata('id'),
			'id_comprador' => $id_cliente,
			'monto' => $monto,
			'descuento_porcentaje' => $descuentoPocentaje,
			'descuento' => $descuentoPrecio,
			'monto_total' => $precio_final,
			'fecha_venta' => $fecha_venta,
			'factura' => $factura,
			'noPagos' => $noPagos,
			'tipoPago' => $tipoPago
		);

		$sql = $this->db->insert('ventas',$data);
		if($sql){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function agregarVentaMedio($idVenta, $medio,$fechaInicio,$fechaTermino,$horai,$horaf,$id_chofer){
		$data = array(
			'id_medio' => $medio,
			'id_venta' => $idVenta,
			'fecha_inicio_contrato' => $fechaInicio,
			'fecha_termino_contrato' => $fechaTermino,
			'hora_inicio' => $horai,
			'hora_termino' => $horaf,
			'id_chofer' => $id_chofer,

		);
		$sql = $this->db->insert('venta_medios',$data);
		if($sql){
			return true;
		}else{
			return false;
		}
	}


	public function eliminarVenta($idVenta){
		$sql = $this->db->delete('ventas',array('id' => $idVenta));
		if($sql){
			return true;
		}else{
			return false;
		}
	}

	public function obtenerVenta_mediosPorFechaInicio($date){
		$sql = $this->db->get_where("venta_medios",array("fecha_inicio_contrato" => $date));
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	public function obtenerVenta_mediosQueEstaranDisponiblesEnUnMes($unMes){
        $this->db->select("*");
        $this->db->from("medios");
        $this->db->join("venta_medios","venta_medios.id_medio = medios.id");
        $this->db->where("venta_medios.fecha_termino_contrato <",$unMes);
        $this->db->where("medios.status","OCUPADO");
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

	public function obtenerVenta_mediosPorFechaTermino($date){
		$sql = $this->db->get_where("venta_medios",array("fecha_termino_contrato" => $date));
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}
}