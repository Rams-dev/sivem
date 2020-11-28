<?php
class MaterialesModel extends CI_model{

	 function __construct()
	{
		$this->load->database();
	}

	public function agregarMaterial($nombre, $precio,$observacion){
		$data = array('material' => $nombre,
						'precio' => $precio,
						'observaciones' => $observacion 
				);
		$sql = $this->db->insert('materiales',$data);
		if(!$sql){
			return false;
		}else{
		return true;
	}}


	public function obtenerMateriales(){
		$sql = $this->db->get('materiales');
		return $sql->result_array();
	}

	public function eliminarMaterial($id){
		$sql = $this->db->delete("materiales",array("id" => $id));
		if($sql){
			return true;
		}else{
			return false;
		}
	} 

	public function obtenerMaterialPorId($id){
		$sql = $this->db->get_where('materiales', array('id' => $id));
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}
}