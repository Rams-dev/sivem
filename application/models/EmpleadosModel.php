<?php
class EmpleadosModel extends CI_model{

	 function __construct()
	{
		$this->load->database();
    }

    function obtenerEmpleados(){
            $sql = $this->db->get('usuarios');
            return $sql->result_array();

    }
    

    function agregarEmpleado($nombre,$apellidos,$contrasenia,$correo,$puesto,$sexo,$telefono,$tipo,$accesso){

            $data = array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'contrasena' => $contrasenia,
                'tipo' => $tipo,
                'acceso' => $accesso,
                'puesto' => $puesto,
                'sexo' => $sexo,
                'telefono' => $telefono,
            );
            $sql = $this->db->insert('usuarios',$data);
            if($sql){
                return true;
            }else{
                return false;
            }
    }

    function EliminarEmpleado($id_empleado){
        $sql = $this->db->delete("usuarios",array("id" => $id_empleado));
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    function obtenerEmpleadoPoId($id){
        $sql = $this->db->get_where("usuarios", array("id" => $id));
        if($sql){
            return $sql->result_array();
        }else{
            false;
        }
        
    }

    function editarEmpleado($id,$nombre,$apellidos,$contrasenia,$correo,$puesto,$sexo,$telefono,$tipo,$accesso){
        $data = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'correo' => $correo,
            'contrasena' => $contrasenia,
            'tipo' => $tipo,
            'acceso' => $accesso,
            'puesto' => $puesto,
            'sexo' => $sexo,
            'telefono' => $telefono,
        );

        $this->db->where("id",$id);
        $sql = $this->db->update("usuarios",$data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }

     function actualizarUsuario($id,$nombre,$apellidos,$contrasena,$correo,$puesto,$sexo,$telefono){
        $data = array(
            "nombre" =>$nombre,
            "apellidos" =>$apellidos,
            "correo" =>$correo,
            "contrasena" =>$contrasena,
            "puesto" =>$puesto,
            "sexo" =>$sexo,
            "telefono" =>$telefono
        );
        $this->db->where("id",$id);
        $sql = $this->db->update("usuarios",$data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    
}