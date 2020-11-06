<?php
class VentasModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function esemero($s, $celular, $telefono){
		$sql = $this->db->get('status');
		return $sql->result_array();
	}

	public function agregarPropietarioEspectacular($nombre,$celular,$telefono){
		$datos = array('nombre' => $nombre,
						'telefono' => $telefono,
						'celular' => $celular,);	
        $sql = $this->db->insert('propietarios',$datos);
		if($sql){
            $this->db->select('id');
            $idQuery = $this->db->get_where('propietarios', array('celular' => $celular),1);
			return $idQuery->result_array();
		}else
		return false;
	}

	public function agregarVenta($id_cliente,$monto,$fecha_venta,$factura){
		$data= array(
			'id_vendedor' => $this->session->userdata('id'),
			'id_comprador' => $id_cliente,
			'monto' => $monto,
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

	public function agregarVentaMedio($idVenta, $medio,$noPagos,$tipoPago,$fechaInicio,$fechaTermino,$tipoArte){
		$data = array(
			'id_medio' => $medio,
			'id_venta' => $idVenta,
			'no_pagos' => $noPagos,
			'tipo_pago' => $tipoPago,
			'fecha_inicio_contrato' => $fechaInicio,
			'fecha_termino_contrato' => $fechaTermino,
			'tipo_de_arte' => $tipoArte

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
}