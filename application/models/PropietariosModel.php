<?php
class PropietariosModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerPropietarios(){
		$sql = $this->db->get("propietarios");
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	public function obtenerPropietarioPorId($id){
		$sql = $this->db->get_where("propietarios", array("id" => $id));
		if($sql){
			return $sql->result_array();
		}else{
			return false;
		}
	}

	public function agregarPropietarioEspectacular($nombre,$celular,$telefono){
		$datos = array('nombre' => $nombre,
						'telefono' => $telefono,
						'celular' => $celular,);	
        $sql = $this->db->insert('propietarios',$datos);
		if($sql){
            return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	public function editarPropietarioEspectacular($id, $nom, $cel, $tel){
		$data = array(
			'nombre' => $nom,
			'telefono' => $tel,
			'celular' => $cel
		);
		$this->db->where('id',$id);
		$sql = $this->db->update('propietarios', $data);
		if($sql){
			return true;
		}else{
			return false;
		}
			
	}

	function eliminarPropietario($id){
		$sql = $this->db->delete('propietarios', array('id' => $id));
		if($sql){
			return true;
		}else{
			return false;
		}
	}
}