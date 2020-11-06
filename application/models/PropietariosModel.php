<?php
class PropietariosModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obternerIdUsuario($s, $celular, $telefono){
		$sql = $this->db->get('status');
		return $sql->result_array();
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
	
	public function editarPropietarioEspectacular($id, $nom, $tel, $cel){
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
}