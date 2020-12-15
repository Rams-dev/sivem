<?php
class EstadosModel extends CI_model{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerMunicipios($id_estado){
		$sql = $this->db->get_where('municipios',array('estado_id' => $id_estado));
		if(!$sql){
			return false;
		}else{
		return $sql->result_array();
	}}
}