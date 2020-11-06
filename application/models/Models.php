<?php
class Models extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerStatus(){
		$sql = $this->db->get('status');
		return $sql->result_array();
	}

	public function addLonche($producto_id,$cantidad,$precio){
		$datos = array('usuario_id' => $this->session->userdata('id'),
						'producto_id' => $producto_id,
						'cantidad' => $cantidad,
						'precio' => $precio,
						'total' => $precio * $cantidad);	
		$sql = $this->db->insert('lonche',$datos);
		if($sql){
			return true;
		}else
		return false;
	}

	function obtenerTiposdePago(){
		$sql = $this->db->get('tipos_pago');
		return $sql->result_array();
	}

	function obtenerPeriodosDePago(){
		$sql = $this->db->get('periodo_pago');
		return $sql->result_array();

	}

	function obtenerEstados(){
		$sql = $this->db->get('estados');
		return $sql->result_array();
	}

	

	

}