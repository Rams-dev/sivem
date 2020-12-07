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
    

    function agregarEmpleado($nombre,$apellidos,$contrasenia,$correo,$puesto,$licencia,$sexo,$telefono,$tipo,$accesso){

            $data = array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'contrasena' => $contrasenia,
                'tipo' => $tipo,
                'acceso' => $accesso,
                'puesto' => $puesto,
                'licencia' => $licencia,
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

    function editarEmpleado($id,$nombre,$apellidos,$contrasenia,$correo,$puesto,$licencia,$sexo,$telefono,$tipo,$accesso){
        $data = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'correo' => $correo,
            'contrasena' => $contrasenia,
            'tipo' => $tipo,
            'acceso' => $accesso,
            'puesto' => $puesto, 
            'licencia' => $licencia ,
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

    public function obtenerChoferes(){
        $this->db->where("licencia !=","");
        $sql = $this->db->get_where("usuarios");
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

     public function obtenerChoferesDisponibles($h1,$h2,$f1,$f2){
         $this->db->select("*");
         $this->db->venta_medios("venta_medios", "usuarios.id = venta_medios.id_chofer");
         $this->db->where("venta_medios.fecha_inicio_contrato <", $f1);
         $this->db->where("venta_medios.fecha_inicio_contrato <", $f2);
         $this->db->where("venta_medios.fecha_termino_contrato >", $f1);
         $this->db->where("venta_medios.fecha_termino_contrato >", $f2);
         $this->db->where("venta_medios.hora_inico <", $h1);
         $this->db->where("venta_medios.hora_inicio <", $h2);
         $this->db->where("venta_medios.hora_inico >", $h1);
         $this->db->where("venta_medios.hora_inicio >", $h2);

         $sql = $this->db->get("usuarios");

         if($sql){
             return $sql->result_array();
         }else{
             false;
         }
         
     }

    
}