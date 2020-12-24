<?php
class MediosModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function agregarMedio($status,$precio,$tipo_medio,$fechaInicioOcupacion,$fechaTerminooOcupacion){
		$datos = array(
						'tipo_medio' => $tipo_medio,
						'status' => $status,
                        'precio' => $precio,
                        "fecha_inicio_ocupacion" => $fechaInicioOcupacion,
                        "fecha_termino_ocupacion" => $fechaTerminooOcupacion
                    );
		$sql = $this->db->insert('medios',$datos);
		if($sql){
            return $this->db->insert_id();
		}else{
    		return false;
        }
    }

    public function guardarCambiosMedio($medio_id,$precio,$status){
        $datos = array(
            'status' => $status,
            'precio' => $precio,
        );
        $this->db->where('id', $medio_id);
        $sql = $this->db->update('medios', $datos);
        if($sql){
            return true;
        }else{
            return false;
        }
    }


    public function getMediosHttp($id_estado ="",$municipio ="",$status ="",$tipo_medio=""){

        // return array($id_estado,$status,$tipo_medio);
        if($tipo_medio !=""){
            // exit;
            $this->db->select("*");
            $this->db->from($tipo_medio);
            $this->db->select("medios.id, medios.precio as costo_total");
            $this->db->join('medios','medios.id = '.$tipo_medio.'.id_medio');
            if($tipo_medio != "vallas_moviles"){
                $this->db->select("estados.nombre as nombre_estado");
                $this->db->join("estados", "estados.id = ".$tipo_medio.".id_estado");
            }
            if($tipo_medio == "espectaculares"){
                $this->db->select("materiales.precio as precio_material, materiales.material, materiales.unidad as unidad");
                $this->db->join("materiales", "materiales.id = ".$tipo_medio.".id_material");
            }
            if($id_estado != "" || $id_estado != null){
                $this->db->where($tipo_medio.'.id_estado', $id_estado);
            }
            if($municipio != "" || $municipio != null){
                $this->db->like($tipo_medio.'.municipio', $municipio,'both');
            }
         
        }else{
            //  $this->db->join("espectaculares","medios.id = espectaculares.id_medio","outer");
            //  $this->db->join("vallas_fijas","medios.id = vallas_fijas.id_medio","outer");
            return false;
            exit;
        }
       
          if($status != '' || $status != null){
            $this->db->where('medios.status', $status);
          }
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }

    }
    // public function obtenerMedios($id_medio,$fi, $ft){
    //     $medio="";
    //     if($id_medio === '1'){
    //         $medio = 'espectaculares';
    //     }elseif($id_medio == '2'){
    //         $medio = 'vallas_fijas';
    //     }elseif($id_medio == '3'){
    //         $medio = 'vallas_moviles';
    //     }
    //     $this->db->select('*');
    //     $this->db->from($medio);
    //     $this->db->join('venta_medios','venta_medios.id_medio = '.$medio.'.id_medio');
    //     $this->db->where("venta_medios.fecha_inicio_contrato >", $fi);
    //     $this->db->where("venta_medios.fecha_inicio_contrato >", $ft);
    //     $this->db->or_where("venta_medios.fecha_termino_contrato <", $fi);
    //     $this->db->where("venta_medios.fecha_termino_contrato <", $ft);
    //     $this->db->group_by($medio.'.id_medio');
    //     $sql = $this->db->get();
    //     if($sql){
    //         return $sql->result_array();
    //     }else{
    //         return false;
    //     }
    // }



    public function obtenerMediosDisponibles($id_medio){
        $medio="";
        if($id_medio === '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'vallas_fijas';
        }elseif($id_medio == '3'){
            $medio = 'vallas_moviles';
        }
        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio.'.id_medio');
        $this->db->where("medios.status = 'DISPONIBLE'");
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    //obtiene todos los medios que estan apartados, ocupados y/o proximos que se pueden vender
    public function obtenerMediosApartados($id_medio, $fi, $ft){
        $hoy = date("Y:m:d");
        $medio = "";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'vallas_fijas';
        }elseif($id_medio == '3'){
            $medio = 'vallas_moviles';
        }

        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio .'.id_medio');
        $this->db->join('venta_medios','medios.id = venta_medios.id_medio');
        $this->db->where("venta_medios.fecha_inicio_contrato >", $fi);
        $this->db->where("venta_medios.fecha_inicio_contrato >", $ft);
        $this->db->or_where("venta_medios.fecha_termino_contrato <", $fi);
        $this->db->where("venta_medios.fecha_termino_contrato <", $ft);
        $this->db->where("venta_medios.fecha_termino_contrato >", $hoy);
        $this->db->group_by('medios.id');
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }


    public function obtenerMediosDisponiblesQueEstanEnVenta($hoy){
        $this->db->select("*");
        $this->db->from("medios");
        $this->db->join("venta_medios","venta_medios.id_medio = medios.id");
        $this->db->where("medios.status","DISPONIBLE");
        $this->db->where("venta_medios.fecha_inicio_contrato >",$hoy);
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }

    }


    // public function obtenerMediosApartadosPorFecha($id_medio,$f1,$f2){
    //     $medio="";
    //     if($id_medio == '1'){
    //         $medio = 'espectaculares';
    //     }elseif($id_medio == '2'){
    //         $medio = 'vallas_fijas';
    //     }elseif($id_medio == '3'){
    //         $medio = 'vallas_moviles';
    //     }
    //     $this->db->select('*');
    //     $this->db->from($medio);
    //     $this->db->join('medios','medios.id = '.$medio .'.id_medio');
    //     $this->db->join('venta_medios','venta_medios.id_medio = medios.id');
    //     $this->db->where("venta_medios.fecha_inicio_contrato >",$f1);
    //     $this->db->where("venta_medios.fecha_inicio_contrato >",$f2);
    //     $this->db->or_where("venta_medios.fecha_termino_contrato <",$f1);
    //     $this->db->where("venta_medios.fecha_termino_contrato <",$f2);
    //     $this->db->group_by('medios.id');
    //     $sql = $this->db->get();
    //     if($sql){
    //         return $sql->result_array();
    //     }else{
    //         return false;
    //     }
    // }


    //funcion que trae los medios que tengan una fecha diferente a la de la compra
    public function obtenerMediosConFechaDeOcupacion($id_medio,$f1,$f2){
        $medio="";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'vallas_fijas';
        }elseif($id_medio == '3'){
            $medio = 'vallas_moviles';
        }
        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio .'.id_medio');
        $this->db->where("medios.fecha_inicio_ocupacion >",$f1);
        $this->db->where("medios.fecha_inicio_ocupacion >",$f2);
        $this->db->or_where("medios.fecha_termino_ocupacion <",$f1);
        $this->db->where("medios.fecha_termino_ocupacion <",$f2);
        $this->db->where("medios.fecha_termino_ocupacion !=","");
        $this->db->where("medios.fecha_termino_ocupacion !=","");
        $this->db->group_by('medios.id');
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }


    public function obtenerMediosOcupadosPorFecha($id_medio,$f1,$f2){
        $medio="";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'vallas_fijas';
        }elseif($id_medio == '3'){
            $medio = 'vallas_moviles';
        }
        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio .'.id_medio');
        $this->db->join('venta_medios','venta_medios.id_medio = medios.id');
        $this->db->where("venta_medios.fecha_inicio_contrato >=",$f1);
        $this->db->where("venta_medios.fecha_inicio_contrato <=",$f2);
        $this->db->or_where("venta_medios.fecha_termino_contrato >=",$f1);
        $this->db->where("venta_medios.fecha_termino_contrato <=",$f2);
        $this->db->or_where("venta_medios.fecha_termino_contrato <=",$f1);
        $this->db->where("venta_medios.fecha_inicio_contrato >=",$f1);
        $this->db->where("venta_medios.fecha_termino_contrato <=",$f2);
        $this->db->group_by('medios.id');
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }



    }

    // public function obtenerMediosReservados($id_medio,$fecha_inicio,$fecha_termino){
    //     $medio="";
    //     if($id_medio == '1'){
    //         $medio = 'espectaculares';
    //     }elseif($id_medio == '2'){
    //         $medio = 'Vallas fijas';
    //     }elseif($id_medio == '3'){
    //         $medio = 'Vallas moviles';
    //     }
    //     $this->db->select('*');
    //     $this->db->from('medios');
    //     $this->db->join('venta_medios','venta_medios.id_medio = medios.id');
    //     $this->db->join($medio,'medios.id = '.$medio.'.id_medio');

    //      $this->db->where("fecha_inicio_contrato >",$fecha_inicio );
    //      $this->db->where("fecha_inicio_contrato >",$fecha_termino );
    //      $this->db->or_where("fecha_termino_contrato <",$fecha_inicio );
    //      $this->db->where("fecha_termino_contrato <",$fecha_termino );
    //     $this->db->group_by('venta_medios.id_medio');

    //     $sql = $this->db->get();
    //     if($sql){
    //         return $sql->result_array();
    //     }else{
    //         return false;
    //     }

    // }

    

    public function obtenerDatosMedioporId($id){
        $sql = $this->db->get_where("medios",array("id" => $id));
        if($sql){
            return $sql->result_array();
        }
    }



    function obtenerMediosPorId($medios_id,$tabla){
        if($tabla == "valla_fija"){
            $tabla = "vallas_fijas";
        }
        if($tabla == "Espectacular"){
            $tabla = "espectaculares";
        }
        if($tabla == "Vallas movil"){
            $tabla = "vallas_moviles";
        }
        $this->db->select('*');
        $this->db->from($tabla);
        $this->db->join('medios', 'medios.id ='. $tabla.'.id_medio','inner');
        $this->db->where('medios.id', $medios_id);
        $sql= $this->db->get();
        return $sql->result_array();
    }



    function cambiarStatusMedio($id_medio){
        $apartado = 'APARTADO';
        $this->db->set('status',$apartado);
        $this->db->where('id', $id_medio);
        $sql = $this->db->update('medios');
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function cambiarStatusABloqueado($id_medio){
        $bloqueado = 'BLOQUEADO';
        $this->db->set('status',$bloqueado);
        $this->db->where('id', $id_medio);
        $sql = $this->db->update('medios');
        if($sql){
            return true;
        }else{
            return false;
        }
    }

   
    function eliminarMedio($id_medio){
        $sql = $this->db->delete('medios',array('id' => $id_medio));
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    function cambiarStatusApartadoAOcupado($id_medio){
        $data = array(
            "status"=> "OCUPADO"
        );
        $this->db->where("id",$id_medio);
        $this->db->update("medios", $data);
    }

    public function cambiarStatusOcupadoAProximo($id){
        $data = array(
            "status"=> "PROXIMO",
        );
        $this->db->where("id",$id);
        $this->db->update("medios", $data);
    }

    function cambiarStatusProximoADisponible($id_medio){
        $data = array(
            "status"=> "DISPONIBLE",
            "fecha_inicio_ocupacion" => "",
            "fecha_termino_ocupacion" => ""
        );
        $this->db->where("id",$id_medio);
        $this->db->update("medios", $data);
    }


    public function obtenerMediosOcupadosSinFechadeInicio($date){
        $sql = $this->db->get_where("medios",array("fecha_termino_ocupacion <=" => $date));
        return $sql->result_array();
    }

    
    public function obtenerMediosProximosSinFechadeInicio($date){
        $sql = $this->db->get_where("medios",array("fecha_termino_ocupacion" => $date));
        return $sql->result_array();

    }

    
    public function obtenerMediosApartadosSinVenta($date){
        $sql = $this->db->get_where("medios",array("fecha_inicio_ocupacion" => $date));
        return $sql->result_array();

    }

    // esta funcion cambia el estatus de los medios que al momento de registrase los declararon como ocupados

    
    public function CambiarApartadoAOcupado($id){
        $data = array(
            "status"=> "OCUPADO",
        );
        $this->db->where("id",$id);
        $this->db->update("medios", $data);
    }


}
