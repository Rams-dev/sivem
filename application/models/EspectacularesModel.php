<?php
class EspectacularesModel extends CI_model{

	 function __construct()
	{
		$this->load->database();
	}

    
    
	public function obtenerEspectaculares(){
        $this->db->select('medios.id, espectaculares.id as espectacular_id,nocontrol, costo_impresion,costo_instalacion, calle,
        numero,
        tipo_medio,
        costo_renta,
        colonia,
        localidad,
        municipio,
        id_estado,
        latitud,
        longitud,
        referencias,
        ancho,
        alto,
        espectaculares.observaciones as observaciones,
        id_material,
        acabados,
        status,
        vista_corta,
        vista_media,
        vista_larga,
        id_propietario,
        fecha_inicio,
        fecha_termino,
        monto,
        medios.precio as precio,
        medios.id as id_medio,
        folio,
        id_tipo_pago,
        id_periodo_pago,
        propietarios.id as id_prop,
        propietarios.nombre,
        propietarios.telefono,
        propietarios.celular,
        periodo_pago.periodo as periodo,
        estados.nombre as nombre_estado,
        ');
        $this->db->from('espectaculares');
        $this->db->join('propietarios', 'propietarios.id = espectaculares.id_propietario','inner');
        $this->db->join('periodo_pago', 'periodo_pago.id = espectaculares.id_periodo_pago','inner');
        $this->db->select('tipos_pago.nombre as tipo_de_pago');
        $this->db->join('tipos_pago', 'tipos_pago.id = espectaculares.id_tipo_pago','inner');
        $this->db->select('material, materiales.precio as precio_material, materiales.unidad');
        $this->db->join('materiales', 'materiales.id = espectaculares.id_material','inner');
        $this->db->join('estados', 'estados.id = espectaculares.id_estado','inner');
        //$this->db->select('medios.monto as monto medios.id as id_medio');
        $this->db->join('medios', 'medios.id = espectaculares.id_medio','inner');
        $sql = $this->db->get();
        
		return $sql->result_array();
    }

    
    public function obtenerEspectacularesPorId($id){
        $this->db->select('medios.id,espectaculares.id as espectacular_id,nocontrol, costo_impresion,costo_instalacion, calle,
        numero,
        colonia,
        costo_renta,
        localidad,
        municipio,
        id_estado,
        latitud,
        longitud,
        referencias,
        ancho,
        alto,
        espectaculares.observaciones as observaciones,
        id_material,
        acabados,
        status,
        vista_corta,
        vista_media,
        vista_larga,
        id_propietario,
        fecha_inicio,
        fecha_termino,
        monto,
        folio,
        id_tipo_pago,
        id_periodo_pago,
        propietarios.id as id_prop,
        propietarios.nombre,
        propietarios.telefono,
        propietarios.celular,
        periodo_pago.periodo as periodo,
        ');
        $this->db->from('espectaculares');
        $this->db->join('propietarios', 'propietarios.id = espectaculares.id_propietario','left');
        $this->db->join('periodo_pago', 'periodo_pago.id = espectaculares.id_periodo_pago','left');
        $this->db->select('tipos_pago.nombre as tipo_de_pago');
        $this->db->join('tipos_pago', 'tipos_pago.id = espectaculares.id_tipo_pago','left');
        $this->db->select('material, materiales.precio as precio_material, materiales.unidad');
        $this->db->join('materiales', 'materiales.id = espectaculares.id_material','left');
        $this->db->select('estados.nombre as nombre_estado');
        $this->db->join('estados', 'estados.id = espectaculares.id_estado','left');
        $this->db->select('medios.precio as precio, medios.id as id_medio');
        $this->db->join('medios', 'medios.id = espectaculares.id_medio','left');
        $this->db->where('medios.id', $id);
        $sql= $this->db->get();
        return $sql->result_array();
    }
    
    
    public function agregarEspectacular($id_medio,
    $ncontrol,
    $cRenta,
    $cimpreso,
    $instalacion,
    $calle,
    $numero,
    $colonia,
    $localidad,
    $estado,
    $municipio,
    $latitud,
    $longitud,
    $referencias,
    $ancho,
    $alto,
    $material,
    $observaciones,
    $acabados,
    $idProp,
    $iniciocontrato,
    $fincontrato,
    $monto,
    $folio,
    $tipopago,
    $periodopago,
    $imagen1,
    $imagen2,
    $imagen3){

        $data = array('nocontrol' => $ncontrol,
        'costo_renta' => $cRenta,
        'costo_impresion' => $cimpreso,
        'costo_instalacion' => $instalacion,
        'calle' => $calle,
        'numero' => $numero,
        'colonia' => $colonia,
        'localidad' => $localidad,
        'municipio' => $municipio,
        'id_estado' => $estado,
        'latitud' => $latitud,
        'longitud' => $longitud,
        'referencias' => $referencias,
        'ancho' => $ancho,
        'alto' => $alto,
        'id_material' => $material,
        'observaciones' => $observaciones,
        'acabados' => $acabados,
        'vista_corta' => $imagen1,
        'vista_media' => $imagen2,
        'vista_larga' => $imagen3,
        'id_propietario' => $idProp,
        'id_medio' => $id_medio,
        'fecha_inicio' => $iniciocontrato,
        'fecha_termino' => $fincontrato,
        'folio' => $folio,
        'id_tipo_pago' => $tipopago,
        'id_periodo_pago' => $periodopago,
        'monto' => $periodopago
        );

        $sql = $this->db->insert('espectaculares',$data);
        if(!$sql){
            return false;
        }else{
        return true;
        }
    }

    function eliminarEspectacular($id){
        $sql = $this->db->delete('espectaculares', array('id_medio' => $id));
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    function editarEspectacular(
        $id,
        $ncontrol,
        $cRenta,
        $cimpreso,
        $instalacion,
        $calle,
        $numero,
        $colonia,
        $localidad,
        $estado,
        $municipio,
        $latitud,
        $longitud,
        $referencias,
        $ancho,
        $alto,
        $material,
        $observaciones,
        $acabados,
        $id_prop,
        $id_medio,
        $iniciocontrato,
        $fincontrato,
        $monto,
        $folio,
        $tipopago,
        $periodopago,
        $imagen1,
        $imagen2,
        $imagen3){

        $data = array(
            'nocontrol' => $ncontrol,
            'costo_renta' => $cRenta,
            'costo_impresion' => $cimpreso,
            'costo_instalacion' => $instalacion,
            'calle' => $calle,
            'numero' => $numero,
            'colonia' => $colonia,
            'localidad' => $localidad,
            'municipio' => $municipio,
            'id_estado' => $estado,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'referencias' => $referencias,
            'ancho' => $ancho,
            'alto' => $alto,
            'id_material' => $material,
            'observaciones' => $observaciones,
            'acabados' => $acabados,
            'id_propietario' => $id_prop,
            'id_medio' => $id_medio,
            'fecha_inicio' => $iniciocontrato,
            'fecha_termino' => $fincontrato,
            'folio' => $folio,
            'id_tipo_pago' => $tipopago,
            'id_periodo_pago' => $periodopago,
            'monto' =>$monto
        );

     
        if($imagen1 != ""){
            $data += [ "vista_corta" => $imagen1];
        }
        if($imagen2 != ""){
            $data += [ "vista_media" => $imagen2];

        }
        if($imagen3 != ""){
            $data += ['vista_larga' => $imagen3];
        }
       
        $this->db->where('id', $id);
        $sql = $this->db->update('espectaculares', $data);
        if($sql){
            return true;
        }else{
            return false;
        }
    }

    function obtenerEspectacularesPorIdMedio($id_medio){
        $sql = $this->db->get_where('espectaculares',array('id_medio' => $id_medio));
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }

    function espectacularesQueTerminaraSucontratoDentroDeUnMes($dentroDeUnMes){
        $hoy = Date("Y:m:d");
        $this->db->select("*");
        $this->db->join("medios","espectaculares.id_medio = medios.id");
        $this->db->join("propietarios", "espectaculares.id_propietario = propietarios.id");
        $this->db->where('espectaculares.fecha_termino <=', $dentroDeUnMes);
        $this->db->where('espectaculares.fecha_termino >', $hoy);
        $sql = $this->db->get("espectaculares");
        if($sql){
            return $sql->result_array();
        }else{
            return false;
        }
    }
    //obtiene los Espectaculares cuya fecha de termino sea hoy 

    public function obtenerEspectacularesTerminoRenta($hoy){
        $sql = $this->db->get_where("espectaculares",array("fecha_termino" => $hoy));
        if($sql){
            return $sql ->result_array();
        }else{
            return false;
        }
    }

}