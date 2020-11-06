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

	public function getProductoDetails($producto_id){
		$sql = $this->db->get_where('comida',array('id' => $producto_id));
		return $sql->result_array();

	}

	public function getPromocionDetails($producto_id){
		$sql = $this->db->get_where('promociones',array('id' => $producto_id));
		return $sql->result_array();

	}
	public function agPromocion($nombre,$productos,$precio,$imagen){
		$data=array(
			"nombre_promocion" => $nombre,
			"productos" => $productos,
			"precio" => $precio,
			"imagen" => $imagen
		);
		$sql = $this->db->insert("promociones",$data);
		if($sql){
			return true;
		}else{
			return false;
		}

	}

	public function eliminarProducto($id){
		$sql = $this->db->delete('comida',array('id' => $id));

		if($sql){
			return true;
		}else{
			return false;
		}
	}

			/* promociones */

	public function getPromociones(){
		$sql = $this->db->get("promociones");
		return $sql->result_array();

	}

	public function getPromocionesById($id_promocion){
		$sql = $this->db->get_where('promociones',array('id' => $id_promocion));
		return $sql->result_array();
	}

	public function eliminarPromocion($id){
		$sql = $this->db->delete('promociones',array('id' => $id));

		if($sql){
			return true;
		}else{
			return false;
		}

	}
}