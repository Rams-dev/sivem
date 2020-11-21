<?php
class ClientesModel extends CI_model{

	 function __construct()
	{
		$this->load->database();
	}

    
    
	public function obtenerClientes(){
        $this->db->select('clientes.id, clientes.nombre, rfc, domicilio,colonia, poblacion, estados.id as id_estado, estados.nombre as estado,cp,nombre_encargado, puesto, telefono,correo');
         $this->db->from('clientes');
         $this->db->join('estados', 'estados.id = clientes.id_estado');
         $sql= $this->db->get();
		return $sql->result_array();
    }

    public function obtenerClientesPorId($id){
        $this->db->select('clientes.id, clientes.nombre, rfc, domicilio,colonia, poblacion,estados.id as id_estado, estados.nombre as estado,cp,nombre_encargado, puesto, telefono,correo');
         $this->db->from('clientes');
         $this->db->join('estados', 'estados.id = clientes.id_estado');
         $this->db->where('clientes.id',$id);
         $sql= $this->db->get();
		return $sql->result_array();
    }

    function agregarCliente($rz,$rfc,$domicilio,$colonia,$poblacion, $estado, $cp, $nombre,$puesto, $telefono, $correo){
        $data = array(
            'nombre' => $rz,
            'rfc' => $rfc,
            'domicilio' => $domicilio,
            'colonia' => $colonia,
            'poblacion' => $poblacion,
            'id_estado' => $estado,
            'cp' => $cp,
            'nombre_encargado' => $nombre,
            'puesto' => $puesto,
            'telefono' => $telefono,
            'correo' => $correo
        );

        $sql = $this->db->insert('clientes', $data);
        if($sql){
            return true;
        }else{
            return false;
        }

    }

    function editarCliente($rz,$rfc,$domicilio,$colonia,$poblacion, $estado, $cp, $nombre,$puesto, $telefono, $correo,$id){
        $data = array(
            'nombre' => $rz,
            'rfc' => $rfc,
            'domicilio' => $domicilio,
            'colonia' => $colonia,
            'poblacion' => $poblacion,
            'id_estado' => $estado,
            'cp' => $cp,
            'nombre_encargado' => $nombre,
            'puesto' => $puesto,
            'telefono' => $telefono,
            'correo' => $correo
        );
        $this->db->where('id', $id);
        $sql = $this->db->update('clientes', $data);
        
        if($sql){
            return true;
        }else{
            return false;
        }

    }

    function eliminarCliente($id_cliente){        
        $sql = $this->db->delete('clientes', array('id',$id_cliente));
        if($sql){
            return true;
        }else{
            return false;
        }
    }
    
}