<?php
class MaterialesModel extends CI_model{

	 function __construct()
	{
		$this->load->database();
	}

	public function agregarMaterial($nombre, $precio, $unidad, $observacion){
		$data = array('material' => $nombre,
						'precio' => $precio,
						'unidad' => $unidad,
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

	public function editarMaterial($id_material,$nombre,$precio,$unidad, $observacion){
		$data = array(
			"material" => $nombre,
			" precio" => $precio,
			"unidad" => $unidad,
			"observaciones" => $observacion
		);
		$this->db->where("id",$id_material);
		$sql= $this->db->update("materiales",$data);
		if($sql){
			return true;
		}else{
			return false;
		}
	}
}