<?php
class Vallas_movilesModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
    }

    public function agregar($nocontrol,$id_medio,$marca,$modelo,$anio,$precio,$acabados,$anchoLateral,$altoLateral,$materialLateral,$anchoFaldon,$altoFaldon,$materialFaldon,$anchoPuerta,$altoPuerta,$materialPuerta,$anchoFrente,$altoFrente,$materialFrente,$observaciones,$imagen1,$imagen2,$imagen3){
        $data = array(
            "id_medio" => $id_medio,
            "nocontrol" => $nocontrol,
            "marca" => $marca,
            "modelo" => $modelo,
            "anio" => $anio,
            "lateral_ancho" => $anchoLateral,
            "lateral_alto" => $altoLateral,
            "lateral_id_material" => $materialLateral,
            "faldon_ancho" => $anchoFaldon,
            "faldon_alto" => $altoFaldon,
            "faldon_id_material" => $materialFaldon,
            "puerta_ancho" => $anchoPuerta,
            "puerta_alto" => $altoPuerta,
            "puerta_id_material" => $materialPuerta,
            "frente_ancho" => $anchoFrente,
            "frente_alto" => $altoFrente,
            "frente_id_material" => $materialFrente,
            "observaciones" => $observaciones,
            "acabados" => $acabados,
            "vista_corta" => $imagen1,
            "vista_media" => $imagen2,
            "vista_larga" => $imagen3
        );
        $sql = $this->db->insert("vallas_moviles",$data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerVallas_moviles(){
        $this->db->select("*");
        $this->db->join("vallas_moviles","medios.id=vallas_moviles.id_medio");
        // $this->db->join("materiales","materiales.id=vallas_moviles.lateral_id_material");
        $sql = $this->db->get("medios");
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    
    }

    public function obtenerImagenesVallasMovilesPorId($id){
        $sql = $this->db->get_where("vallas_moviles", array("id_medio" => $id));

        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    public function eliminarValla($id_medio){
        $sql = $this->db->delete("vallas_moviles",array("id_medio" => $id_medio));
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerValla_movilPorId($id_medio){
        $this->db->select("*");
        $this->db->join("medios","vallas_moviles.id_medio = medios.id");
        $this->db->where("id_medio",$id_medio);
        $sql = $this->db->get("vallas_moviles");
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }
}