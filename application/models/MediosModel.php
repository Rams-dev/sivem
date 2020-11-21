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
                        'precio' => $precio,
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

    public function obtenerMedios(){
        $this->db->select('*');
        $this->db->from('medios');
        $this->db->join('espectaculares', 'espectaculares.id_medio = medios.id');
        $this->db->join('estados', 'espectaculares.id_estado = estados.id');
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    public function getMediosHttp($id_estado ="",$status ="",$tipo_medio=""){

        // return array($id_estado,$status,$tipo_medio);
        // exit;
        $this->db->select("*");
        $this->db->from('medios');
        if($tipo_medio !=""){
            $this->db->join($tipo_medio,'medios.id = '.$tipo_medio.'.id_medio', "inner");
        }else{
            $this->db->join('espectaculares','medios.id = espectaculares.id_medio', "inner");
            // $this->db->join($tipo_medio,'medios.id = '.$tipo_medio.'.id_medio');
            // $this->db->join($tipo_medio,'medios.id = '.$tipo_medio.'.id_medio');
        }
          if($status != '' || $status != null){
            $this->db->where('medios.status', $status);
          }
         if($id_estado != "" || $id_estado != null){
             if($tipo_medio != ""){
                $this->db->join("estados", "estados.id = ".$tipo_medio.".id_estado", "inner");
                $this->db->where($tipo_medio.'.id_estado', $id_estado);
             }else{
                $this->db->join("estados","estados.id = espectaculares.id_estado", "inner");
                 $this->db->where('espectaculares.id_estado', $id_estado);
             }
        }
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        } else{
            return false;
        }

    }
    public function obtenerMediosDisponibles($id_medio){
        $medio="";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'Vallas fijas';
        }elseif($id_medio == '3'){
            $medio = 'Vallas moviles';
        }
        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio .'.id_medio');
        $this->db->where("medios.status = 'Disponible'");
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    public function obtenerMediosApartados($id_medio){
        $medio="";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'Vallas fijas';
        }elseif($id_medio == '3'){
            $medio = 'Vallas moviles';
        }
        $this->db->select('*');
        $this->db->from($medio);
        $this->db->join('medios','medios.id = '.$medio .'.id_medio');
        $this->db->where("medios.status = 'Apartado'");
        $sql = $this->db->get();
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    public function obtenerMediosReservados($id_medio,$fecha_inicio,$fecha_termino){
        $medio="";
        if($id_medio == '1'){
            $medio = 'espectaculares';
        }elseif($id_medio == '2'){
            $medio = 'Vallas fijas';
        }elseif($id_medio == '3'){
            $medio = 'Vallas moviles';
        }
        $this->db->select('*');
        $this->db->from('medios');
        $this->db->join('venta_medios','venta_medios.id_medio = medios.id');
        $this->db->join($medio,'medios.id = '.$medio.'.id_medio');

         $this->db->where("fecha_inicio_contrato >",$fecha_inicio );
         $this->db->where("fecha_inicio_contrato >",$fecha_termino );
         $this->db->or_where("fecha_termino_contrato <",$fecha_inicio );
         $this->db->where("fecha_termino_contrato <",$fecha_termino );
        $this->db->group_by('venta_medios.id_medio');

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
        $this->db->join('medios', 'medios.id = espectaculares.id_medio','inner');
        $this->db->where('medios.id', $medios_id);
        $sql= $this->db->get();
        return $sql->result_array();
    }


    function cambiarStatusMedio($id_medio){
        $apartado = 'Apartado';
        $this->db->set('status',$apartado);
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
        if($this->db->simple_query($sql)){
            return true;
        }else{
            return false;
        }
    }
}
