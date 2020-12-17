<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vallas_fijas extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MaterialesModel');
		$this->load->model('MediosModel');
		$this->load->model('PropietariosModel');
		$this->load->model('ClientesModel');
        $this->load->model('EspectacularesModel');
        $this->load->model('Vallas_fijasModel');
		$this->load->library('image_lib');
	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
            $data['vallas_fijas'] = $this->Vallas_fijasModel->obtenerVallas_fijas();

		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/vallas_fijas/vallas_fijas',$data);
		$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
    }

    public function agregarVallaFija(){
        if($this->session->userdata('is_logged')){
            $data['tipos_pago'] = $this->Models->obtenerTiposdePago();
            $data['periodos_pago'] = $this->Models->obtenerPeriodosDePago();

            $data['materiales'] = $this->MaterialesModel->obtenerMateriales();
    		$data['estados'] = $this->Models->obtenerEstados();
    		$data['propietarios'] = $this->PropietariosModel->obtenerPropietarios();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_fijas/agregarValla_fija',$data);
            $this->load->view('admin/templates/__footer');
            }else{
                redirect('login');
            }
    }

    function guardarVallaFija(){
        if($this->session->userdata("is_logged")){
            $numcontrol = $this->input->post("numcontrol");
            $ubicacion = $this->input->post("ubicacion");
            $calle = $this->input->post("calle");
            $numero = $this->input->post("numero");
            $colonia = $this->input->post("colonia");
            $localidad = $this->input->post("localidad");
            $estado = $this->input->post("estado");
            $municipio = $this->input->post("municipio");
            $latitud = $this->input->post("latitud");
            $longitud = $this->input->post("longitud");
            $referencias = $this->input->post("referencias");
           
            $ancho = $this->input->post("ancho");
            $alto = $this->input->post("alto");
            $material = $this->input->post("material");
            $costoderenta = $this->input->post("costoderenta");
            $costoimpresion = substr($this->input->post("costodeimpresion"),2);
            $costoinstalacion = substr($this->input->post("costodeinstalacion"),2);
            $precio = substr($this->input->post("precio"),2);
            $status = $this->input->post("status");
            $fechaInicioOcupacion ="";
            $fechaTerminooOcupacion ="";

            if($status == "APARTADO"){
                $fechaInicioOcupacion = $this->input->post("inicioOcupacion");
                $fechaTerminooOcupacion = $this->input->post("terminoOcupacion");
            }elseif($status == "OCUPADO"){
                $fechaTerminooOcupacion = $this->input->post("terminoOcupacion");
            }
            
            
            $observaciones = $this->input->post("observaciones");
            $acabados = $this->input->post("acabados");
            $propietario = $this->input->post("propietario");
            if($propietario == "nuevo"){
                $nombreprop = $this->input->post("nombreprop");
                $celular = intval(join("",explode("-",$this->input->post("celular"))));
                $telefono = intval(join("",explode("-",$this->input->post("telefono"))));
            }else{
                $propietarioReg = $this->input->post("propietarioReg");
                $dataPropietario = $this->PropietariosModel->obtenerPropietarioPorId($propietarioReg);
                foreach($dataPropietario as $prop ){
                    $idprop = $prop['id'];
                    $nombreprop = $prop['nombre'];
                    $celular = $prop['celular'];
                    $telefono = $prop['telefono'];
                }
            }

            $iniciocontrato = $this->input->post("iniciocontrato");
            $fincontrato = $this->input->post("fincontrato");
            $tipopago = $this->input->post("tipopago");
            $periodo = $this->input->post("periodopago");
            $monto = $this->input->post("monto");
            //$folio = $this->input->post("folio");
            // echo json_encode($precio);
            // exit;

			$config['upload_path'] = "./assets/images/medios";
			$config['allowed_types'] = "*";       	
            $this->load->library('upload', $config);
			$imagenes = array();

			if($this->upload->do_upload('imagen1')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
                $imagen1 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen1);
                
			}else{
				echo json_encode("no se subio la imagen1");

			}	

			if($this->upload->do_upload('imagen2')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$imagen2 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen2);

			}else{
				echo json_encode("no se subio la imagen2");

			}

			if($this->upload->do_upload('imagen3')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$imagen3 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen3);

			}else{

				echo json_encode("no se subio la imagen3");
            }
            
            if(count($imagenes)>0){
				for($imagen=0; $imagen < count($imagenes); $imagen++){
					$config['image_library'] = 'gd2';
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width']         = 920;
					$config['height']       = 600;
					$config['source_image'] = './assets/images/medios/'. $imagenes[$imagen];
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
                }
            }


            // echo json_encode(array($status,$precio,$tipo_medio ="valla_fija"));
            if(!$id_medio = $this->MediosModel->agregarMedio($status,$precio,$tipo_medio ="valla_fija",$fechaInicioOcupacion,$fechaTerminooOcupacion)){
                echo json_encode(array("error" => "Intenta mas tarde"));
            }else{
                if($propietario == "nuevo"){
                    if(!$id_prop = $this->PropietariosModel->agregarPropietario($nombreprop,$telefono,$celular)){
                        echo json_encode(array("error" => "Error intenta mas tarde"));
                        $this->MediosModel->eliminarMedio($id_medio);
                        exit;
                    }
                }else{
                    $id_prop = $idprop;
                }

                if($this->Vallas_fijasModel->agregarValla_fija($numcontrol,$costoimpresion,$costoinstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$costoderenta, $observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto)){
                     echo json_encode(array("success" => "Valla agreagada con exito"));
                  }
            }

            // echo json_encode(array($numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto));

            // $formdata = $this->input->post();
            // echo json_encode($formdata);

        }else{
            redirect('login');
        }
    }

    public function editarValla_fija($id_medio){
        if($this->session->userdata('is_logged')){
            $data['vallas_fijas'] = $this->Vallas_fijasModel->obtenerVallasPorIdMedio($id_medio);
            $data['tipos_pago'] = $this->Models->obtenerTiposdePago();
            $data['periodos_pago'] = $this->Models->obtenerPeriodosDePago();
            $data['materiales'] = $this->MaterialesModel->obtenerMateriales();
    		$data['estados'] = $this->Models->obtenerEstados();
    		$data['propietarios'] = $this->PropietariosModel->obtenerPropietarios();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_fijas/editarValla_fija',$data);
            $this->load->view('admin/templates/__footer');
            }else{
                redirect('login');
            }
    }

    public function eliminarVallaFija(){
        if($this->session->userdata('is_logged')){
            $id_medio = $this->input->post();
            $vallas = $this->Vallas_fijasModel->obtenerVallasPorIdMedio($id_medio['id']);
            foreach($vallas as $va){
                $id_prop = $va['id_propietario'];
                unlink("assets/images/medios/". $va['vista_corta']);
                unlink("assets/images/medios/". $va['vista_media']);
                unlink("assets/images/medios/". $va['vista_larga']);
            }
          
            if(!$this->PropietariosModel->eliminarPropietario($id_prop)){
                echo json_encode(array("error" => "no se pudo eliminar los datos del propietario"));
                exit;
            }
            if(!$res1 = $this->MediosModel->eliminarMedio($id_medio['id'])){    
                echo json_encode(array("error" => "intenta mas tarde"));
                exit;
            }else{
                if($r = $this->Vallas_fijasModel->eliminarVallaFija($id_medio['id'])){
                    echo json_encode(array("success" => "Valla eliminada corrrectamente"));
                }else{
                    echo json_encode(array("error" => "intenta más tarde2"));
                }
            }
        }else{
            redirect("login");
        }
    }

    public function obtenerImagenesVallasFijasPorId($id_medio){
        if($this->session->userdata('is_logged')){
            if($data = $this->Vallas_fijasModel->obtenerVallasPorIdMedio($id_medio)){
                echo json_encode($data);
            }
        }else{
            redirect("login");

        }
    }


    public function guardarVallaFijaEditada(){
        if($this->session->userdata('is_logged')){
            $id_medio = $this->input->post("id_medio");
            $numcontrol = $this->input->post("numcontrol");
            $ubicacion = $this->input->post("ubicacion");
            $calle = $this->input->post("calle");
            $numero = $this->input->post("numero");
            $colonia = $this->input->post("colonia");
            $localidad = $this->input->post("localidad");
            $estado = $this->input->post("estado");
            $municipio = $this->input->post("municipio");
            $latitud = $this->input->post("latitud");
            $longitud = $this->input->post("longitud");
            $referencias = $this->input->post("referencias");
            $ancho = $this->input->post("ancho");
            $alto = $this->input->post("alto");
            $material = $this->input->post("material");
            $cRenta = $this->input->post("costoderenta");
            $costoimpresion = substr($this->input->post("costodeimpresion"),2);
            $costoInstalacion = substr($this->input->post("costodeinstalacion"),2);
            $precio = substr($this->input->post("precio"),2);
            $status = $this->input->post("status");
            $observaciones = $this->input->post("observaciones");
            $acabados = $this->input->post("acabados");
            $propietario = $this->input->post("propietario");
            if($propietario == "nuevo"){
                $nombreprop = $this->input->post("nombreprop");
                $celular = intval(join("",explode("-",$this->input->post("celular"))));
                $telefono = intval(join("",explode("-",$this->input->post("telefono"))));
            }else{
                $propietarioReg = $this->input->post("propietarioReg");
                $dataPropietario = $this->PropietariosModel->obtenerPropietarioPorId($propietarioReg);
                foreach($dataPropietario as $prop ){
                    $idprop = $prop['id'];
                    $nombreprop = $prop['nombre'];
                    $celular = $prop['celular'];
                    $telefono = $prop['telefono'];
                }
            }
            $iniciocontrato = $this->input->post("iniciocontrato");
            $fincontrato = $this->input->post("fincontrato");
            $tipopago = $this->input->post("tipopago");
            $periodo = $this->input->post("periodopago");
            $monto = $this->input->post("monto");

            // echo json_encode(array($numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto));
            // exit;

            //$folio = $this->input->post("folio");
           

			$config['upload_path'] = "./assets/images/medios";
			$config['allowed_types'] = "*";       	
            $this->load->library('upload', $config);
            $this->load->library('upload', $config);
			$imagenes = array();

			if($this->upload->do_upload('imagen1')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
                $imagen1 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen1);
                
			}else{
				$imagen1 ="";

			}	

			if($this->upload->do_upload('imagen2')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
                $imagen2 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen2);
                
			}else{
				$imagen2 ="";

			}

			if($this->upload->do_upload('imagen3')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
                $imagen3 = $data['upload_data']['file_name'];
				array_push($imagenes,$imagen3);

			}else{
				$imagen3 ="";
            }
            
/*-------------------------------------------------------- E L I M I N A R    F O T O S --------------------------------- */

            $vallas_fijas = $this->Vallas_fijasModel->obtenerVallasPorIdMedio($id_medio);
            //  var_dump($vallas_fijas);
            //  exit;

            foreach($vallas_fijas as $vallas){

                $id_propietario = $vallas['id_propietario']; 

				if($imagen1 != ""){
					if(file_exists("assets/images/medios/". $vallas['vista_corta'])){
						unlink("assets/images/medios/". $vallas['vista_corta']);
					}
				}
				if($imagen2 != ""){
					if(file_exists("assets/images/medios/". $vallas['vista_media'])){
						unlink("assets/images/medios/". $vallas['vista_media']);
					}
				}
				if($imagen3 != ""){
					if(file_exists("assets/images/medios/". $vallas['vista_larga'])){
						unlink("assets/images/medios/". $vallas['vista_larga']);
					}
				}
            }

            if(count($imagenes)>0){
				for($imagen=0; $imagen < count($imagenes); $imagen++){
					$config['image_library'] = 'gd2';
					$config['create_thumb'] = false;
					$config['maintain_ratio'] = false;
					$config['width']         = 920;
					$config['height']       = 600;
					$config['source_image'] = './assets/images/medios/'. $imagenes[$imagen];
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				}
			}

/**------------------------------------------------ E D I T A R  M E D I O --------------------------------------- */

            // echo json_encode(array($status,$precio,$tipo_medio ="valla_fija"));
            if(!$medio = $this->MediosModel->guardarCambiosMedio($id_medio,$precio,$status)){
                echo json_encode(array("error" => "Intenta mas tarde"));
                exit;
            }else{
                if(!$prop = $this->PropietariosModel->editarPropietario($id_propietario,$nombreprop,$celular,$telefono)){
                    echo json_encode(array("error" => "Error intenta mas tarde"));
                    exit;
                }

            //     echo json_encode(array($id_medio,$numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto
            // ));

                if($this->Vallas_fijasModel->editarValla_fija($id_medio,$numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto)){
                     echo json_encode(array("success" => "Valla editada con exito"));
                }
            }

            // echo json_encode(array($numcontrol,$costoimpresion,$costoInstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto));

            // $formdata = $this->input->post();
            // echo json_encode($formdata);

        }else{
            redirect("login");
        }
    }
}