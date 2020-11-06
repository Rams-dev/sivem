<?php
class MediosModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function agregarMedio($status,$precio,$tipo_medio){
		$datos = array(
						'tipo_medio' => $tipo_medio,
						'status' => $status,
                        'monto' => $precio,
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
            'monto' => $precio,
        );
        $this->db->where('id', $medio_id);
        $sql = $this->db->update('medios', $datos);
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerMediosDisponibles($id_medio){
        $medio="";
        if($id_medio == '1'){
            $medio = 'Espectacular';
        }elseif($id_medio == '2'){
            $medio = 'Vallas fijas';
        }elseif($id_medio == '3'){
            $medio = 'Vallas moviles';
        }
        $this->db->select('*');
        $this->db->from('espectaculares');
        $this->db->join('medios','medios.id = espectaculares.id_medio');
        $this->db->where("medios.status = 'Disponible'",);
        $this->db->where('medios.tipo_medio',$medio);
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }

    }

    function obtenerMediosPorId($medios_id){
        $this->db->select('*');
        $this->db->from('espectaculares');
        $this->db->join('medios', 'medios.id = espectaculares.id_medio','left');
        $this->db->where('medios.id', $medios_id);
        $sql= $this->db->get();
        return $sql->result_array();
    }


    function cambiarStatusMedio($id_medio){
        $ocupado = 'Ocupado';
        $this->db->set('status',$ocupado);
        $this->db->where('id', $id_medio);
        $sql = $this->db->update('medios');
        if($sql){
            return true;
        }else{
            return false;
        }
    }
}
