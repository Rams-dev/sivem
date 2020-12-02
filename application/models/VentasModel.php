<?php
class VentasModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	function obtenerVentas(){
		$this->db->select("*");
		$this->db->from("ventas");
		$this->db->join("venta_medios", "ventas.id_venta = venta_medios.id_venta");
		$this->db->select("usuarios.id as id_vendedor, usuarios.nombre as vendedor, usuarios.apellidos as apellidos_vendedor");
		$this->db->join("usuarios", "ventas.id_vendedor = usuarios.id");
		$this->db->join("espectaculares", "venta_medios.id_medio = espectaculares.id_medio");
		$this->db->join("estados", "espectaculares.id_estado = estados.id");
		$this->db->select("clientes.id as cliente_id, clientes.nombre as comprador, clientes.nombre_encargado, clientes.correo as correo_comprador, clientes.telefono");
		$this->db->join("clientes", "ventas.id_comprador = clientes.id");
		$sql = $this->db->get();
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

	public function agregarVenta($id_cliente,$monto,$descuentoPocentaje, $descuentoPrecio, $precio_final,$fecha_venta,$factura){
		$data= array(
			'id_vendedor' => $this->session->userdata('id'),
			'id_comprador' => $id_cliente,
			'monto' => $monto,
			'descuento_porcentaje' => $descuentoPocentaje,
			'descuento' => $descuentoPrecio,
			'monto_total' => $precio_final,
			'fecha_venta' => $fecha_venta,
			'factura' => $factura,
		);

		$sql = $this->db->insert('ventas',$data);
		if($sql){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function agregarVentaMedio($idVenta, $medio,$noPagos,$tipoPago,$fechaInicio,$fechaTermino){
		$data = array(
			'id_medio' => $medio,
			'id_venta' => $idVenta,
			'no_pagos' => $noPagos,
			'tipo_pago' => $tipoPago,
			'fecha_inicio_contrato' => $fechaInicio,
			'fecha_termino_contrato' => $fechaTermino,

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

	public function obtenerVenta_mediosPorFechaTermino($date){
		$sql = $this->db->get_where("venta_medios",array("fecha_inicio_contrato" => $date));
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}
}