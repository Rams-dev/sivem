<?php
class Vallas_fijasModel extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerVallas_fijas(){
		$sql = $this->db->get('vallas_fijas');
		return $sql->result_array();
    }
    
    public function agregarValla_fija($numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto){

        $data = array(
            'nocontrol'=>$numcontrol,
            'costo_impresion'=>$costoimpresion,
            'costo_instalacion'=>$costoInstalacion,
            'calle'=>$calle,
            'numero'=>$numero,
            'colonia'=>$colonia,
            'localidad'=>$localidad,
            'municipio'=>$municipio,
            'id_estado'=>$estado,
            'latitud'=>$latitud,
            'longitud'=>$longitud,
            'referencias'=>$referencias,
            'ancho'=>$ancho,
            'alto'=>$alto,
            'material'=>$material,
            'observaciones'=>$observaciones,
            'acabados'=>$acabados,
            'vista_corta'=>$imagen1,
            'vista_media'=>$imagen2,
            'vista_larga'=>$imagen3,
            "id_propietario" => $id_prop,
            "id_medio" => $id_medio,
            'fecha_inicio'=>$iniciocontrato,
            'fecha_termino'=>$fincontrato,
            'id_tipo_pago'=>$tipopago,
            'id_periodo_pago'=>$periodo,
            'monto'=>$monto,
        );

        $sql = $this->db->insert('vallas_fijas', $data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }    
}