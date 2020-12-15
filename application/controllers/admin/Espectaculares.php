<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Espectaculares extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('MaterialesModel');
		$this->load->model('Models');
		$this->load->model('EspectacularesModel');
		$this->load->model('PropietariosModel');
		$this->load->model('MediosModel');
		$this->load->model('EstadosModel');

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
			$data['espectaculares'] = $this->EspectacularesModel->obtenerEspectaculares();
			$this->load->view('admin/templates/__head');
			$this->load->view('admin/templates/__nav');
			$this->load->view('admin/espectaculares/espectaculares', $data);
			$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
	}

	public function agregarEspectacular()
	{
		if($this->session->userdata('is_logged')){
		$data['tipos_pago'] = $this->Models->obtenerTiposdePago();
		$data['periodos_pago'] = $this->Models->obtenerPeriodosDePago();
		$data['estados'] = $this->Models->obtenerEstados();
		$data['materiales'] = $this->MaterialesModel->obtenerMateriales();
		
		// $this->load->view('template/__head');
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/espectaculares/agregarEspectacular',$data);
		$this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
	}


	function guardarEspectacular(){
		if($this->session->userdata('is_logged')){

			 $ncontrol = $this->input->post('numcontrol');
			 $cRenta = $this->input->post('costorenta');
			 $cimpreso = $this->input->post('costoimpreso');
			 $instalacion = $this->input->post('instalacion');
			 $calle= $this->input->post('calle');
			 $numero = $this->input->post('numero');
			 $colonia = $this->input->post('colonia');
			 $localidad = $this->input->post('localidad');
			 $dataEstado = explode(',',$this->input->post('estado'));
			 $estado = $dataEstado[0];
			 $municipio = $this->input->post('municipio');
			 $latitud = floatval($this->input->post('latitud'));
			 $longitud = floatval($this->input->post('longitud'));
			 $referencias = $this->input->post('referencias');
			 $ancho = $this->input->post('ancho');
			 $alto = $this->input->post('alto');
			 $dataMaterial = explode(',',$this->input->post('material'));
			 $material = $dataMaterial[0];
			 $precio = $this->input->post('precio');
			 $status = $this->input->post('status');
			 $fechaInicioOcupacion ="";
			 $fechaTerminoOcupacion ="";
 
			 if($status == "APARTADO"){
				 $fechaInicioOcupacion = $this->input->post("inicioOcupacion");
				 $fechaTerminoOcupacion = $this->input->post("terminoOcupacion");
			 }elseif($status == "OCUPADO"){
				 $fechaTerminoOcupacion = $this->input->post("terminoOcupacion");
			 }

			 $observaciones = $this->input->post('observaciones');
			 $acabados = $this->input->post('acabados');
			 $iniciocontrato = $this->input->post('iniciocontrato');
			 $fincontrato = $this->input->post('fincontrato');
			 $monto = $this->input->post('monto');
			 $folio = $this->input->post('folio');
			 $tipopago = $this->input->post('tipopago');
			 $periodopago = $this->input->post('periodopago');
			//  $f = $this->input->post();
			//  echo json_encode($status);
			//  exit;


			$config['upload_path'] = "./assets/images/medios";
			$config['allowed_types'] = "*";       	
			$this->load->library('upload', $config);

			if($this->upload->do_upload('imagen1')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$imagen1 = $data['upload_data']['file_name'];
			}else{
				echo json_encode("no se subio la imagen1");
			}

			if($this->upload->do_upload('imagen2')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$imagen2 = $data['upload_data']['file_name'];
			}else{
				echo json_encode("no se subio la imagen2");
			}

			if($this->upload->do_upload('imagen3')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$imagen3 = $data['upload_data']['file_name'];
			}else{
				echo json_encode("no se subio la imagen3");
			}

			/* datos del propietario */
			$nombreprop = $this->input->post('nombreprop');
			$celular = intval(join('', explode('-',$this->input->post('celular'))));
			$telefono = intval(join('', explode('-',$this->input->post('telefono'))));


			if(!$id_medio= $this->MediosModel->agregarMedio($status,$precio,$tipo_medio = "Espectacular",$fechaInicioOcupacion,$fechaTerminoOcupacion)){
				echo json_encode(array('error' => 'no se pudo registrar el medio.'));
				exit;
			}else{	
				if(!$idProp = $this->PropietariosModel->agregarPropietario($nombreprop,$celular,$telefono)){
					echo json_encode(array('error', 'Fallo al agregar el espectacular'));
				}else{
					
					if(!$sql = $this->EspectacularesModel->agregarEspectacular( 
						$id_medio,
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
						$imagen3)){
							echo json_encode(array('error' => 'No se agrego el espectacular, intenta mas tarde'));	
					}else{
							echo json_encode(array('success' => 'Espectacular agregado'));
					}
				}

			}
		}else{
			redirect('login');
		}
	}

	 function eliminarEspectacular(){
	 	if($this->session->userdata('is_logged')){
			 $idMedio = $this->input->post();
			 $espectacular = $this->EspectacularesModel->obtenerEspectacularesPorIdMedio($idMedio['id']);
			  foreach($espectacular as $esp){
			 	 unlink("assets/images/medios/". $esp['vista_corta']);
			 	 unlink("assets/images/medios/". $esp['vista_media']);
			 	 unlink("assets/images/medios/". $esp['vista_larga']);
				}
				if(!$eP = $this->PropietariosModel->eliminarPropietario($esp["id_propietario"])){
					 echo json_encode(array('error', 'lo siento no se pudo eliminar el especatular, intentalo mas tarde'));
					 exit;
				}

				//echo json_encode('ok');
					if(!$datos = $this->EspectacularesModel->eliminarEspectacular($idMedio['id'])){
						echo json_encode(array('error', 'lo siento no se pudo eliminar el especatular, intentalo mas tarde'));
						exit;
					}else{
					if(!$EM = $this->MediosModel->eliminarMedio($idMedio['id'])){
						echo json_encode(array('error', 'lo siento no se pudo eliminar el especatular, intentalo mas tarde'));
					}else{
						echo json_encode(array('success', 'Espectacular eliminado'));
					}
					}
				

	 	}else{
	 		redirect('login');
	 	}
	 }

	 function editarEspectacular($id){
		 if($this->session->userdata('is_logged')){
			$data['espectaculares'] = $this->EspectacularesModel->obtenerEspectacularesPorId($id);
			$data['tipos_pago'] = $this->Models->obtenerTiposdePago();
			$data['periodos_pago'] = $this->Models->obtenerPeriodosDePago();
			$data['estados'] = $this->Models->obtenerEstados();
			$data['materiales'] = $this->MaterialesModel->obtenerMateriales();

			$this->load->view('admin/templates/__head');
			$this->load->view('admin/templates/__nav');
			$this->load->view('admin/espectaculares/editarEspectacular', $data);
			$this->load->view('admin/templates/__footer');
		 }else{
			 redirect('login');
		 }
	}

	function guardarCambiosEspectacular(){
		if($this->session->userdata('is_logged')){

			$id_espectacular = $this->input->post('espectacular_id');
			$cRenta = $this->input->post('costorenta');
		 	$ncontrol = $this->input->post('numcontrol');
		 	$cimpreso = $this->input->post('costoimpreso');
		 	$instalacion = $this->input->post('instalacion');
		 	$calle= $this->input->post('calle');
		 	$numero = $this->input->post('numero');
		 	$colonia = $this->input->post('colonia');
		 	$localidad = $this->input->post('localidad');
		 	$dataEstado = explode(',',$this->input->post('estado'));
		 	$estado = $dataEstado[0];
		 	$municipio = $this->input->post('municipio');
		 	$latitud = floatval($this->input->post('latitud'));
		 	$longitud = floatval($this->input->post('longitud'));
		 	$referencias = $this->input->post('referencias');
		 	$ancho = floatval($this->input->post('ancho'));
		 	$alto = floatval($this->input->post('alto'));
		 	$dataMaterial = explode(',',$this->input->post('material'));
		 	$material = $dataMaterial[0];
		 	$observaciones = $this->input->post('observaciones');
		 	$acabados = $this->input->post('acabados');
		 	$iniciocontrato = $this->input->post('iniciocontrato');
		 	$fincontrato = $this->input->post('fincontrato');
		 	$monto = $this->input->post('monto');
		 	$folio = $this->input->post('folio');
		 	$tipopago = $this->input->post('tipopago');
			$periodopago = $this->input->post('periodopago');

			// $formData =$this->input->post();
			//   echo json_encode($dataMaterial);
			//    exit;
    	    $config['upload_path'] = "./assets/images/medios";
		    $config['allowed_types'] = "*";       	
		    $this->load->library('upload', $config);

		    if($this->upload->do_upload('imagen1')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
			   $data = array('upload_data' => $this->upload->data());
		 	   $imagen1 = $data['upload_data']['file_name'];
		    }else{
				$imagen1  ='';
		    }
			   

		    if($this->upload->do_upload('imagen2')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
		 	   $data = array('upload_data' => $this->upload->data());
		 	   $imagen2 = $data['upload_data']['file_name'];
		    }else{
				$imagen2 ="";

		    }

		    if($this->upload->do_upload('imagen3')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
		 	   $data = array('upload_data' => $this->upload->data());
		 	   $imagen3 = $data['upload_data']['file_name'];

		    }else{
				$imagen3 ="";
			}

			$espectaculardata = $this->EspectacularesModel->obtenerEspectaculares($id_espectacular);


			foreach($espectaculardata as $datosDeEspectaculares){
				if($imagen1 != ''){
					if(file_exists("assets/images/medios/". $datosDeEspectaculares['vista_corta'])){
						unlink("assets/images/medios/". $datosDeEspectaculares['vista_corta']);
					}
				 }
				 if($imagen2 != ''){
					if(file_exists("assets/images/medios/". $datosDeEspectaculares['vista_media'])){

						unlink("assets/images/medios/". $datosDeEspectaculares['vista_media']);
					}
				 }
				 if($imagen3 != ''){
					if(file_exists("assets/images/medios/". $datosDeEspectaculares['vista_larga'])){

						unlink("assets/images/medios/". $datosDeEspectaculares['vista_larga']);
					}
				 }
			}



			
			/*----------------- datos de medio------------ */
			$medio_id = $this->input->post('id_medio');
			$precio = $this->input->post('precio');
			$status = $this->input->post('status');


			 if(!$edMedio = $this->MediosModel->guardarCambiosMedio($medio_id,$precio,$status)){
			 	echo json_encode(array('error'=>' no se pudeo editar el medio'));
				// echo json_encode(array($medio_id,$precio,$status));
			 	// exit;
			 }
			
		   /* datos del propietario */
		   $id_prop = $this->input->post('id_prop');
		   $nombreprop = $this->input->post('nombreprop');
		   $celular = intval(join('', explode('-',$this->input->post('celular'))));
		   $telefono = intval(join('', explode('-',$this->input->post('telefono'))));
				// echo json_encode(array($id_prop,$nombreprop,$celular,$telefono));
				//  exit;
		   if(!$edProp = $this->PropietariosModel->editarPropietario($id_prop, $nombreprop,$celular,$telefono)){
			   echo json_encode(array('error', 'Fallo al agregar el espectacular'));
		   }

			if(!$sql = $this->EspectacularesModel->editarEspectacular( 
				$id_espectacular,
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
				$medio_id,
				$iniciocontrato,
				$fincontrato,
				$monto,
				$folio,
				$tipopago,
				$periodopago,
				$imagen1,
				$imagen2,
				$imagen3)){
				   echo json_encode(array('error' => 'No se edito el espectacular, intenta mas tarde'));	
		   }else{
					 echo json_encode(array('success' => 'Espectacular editado'));
					//echo json_encode($sql);
		   }
		}else{
			redirect('login');
		}
	}

	function obtenerImagenesEspectacularPorId($id){
		if($imagenesData = $this->EspectacularesModel->obtenerEspectacularesPorIdMedio($id)){
			echo json_encode($imagenesData);
		}else{
			json_encode("error");
		}

	}

	public function obtenerMunicipios($id){
		// $f = $this->input->post();
		$municipios = $this->EstadosModel->obtenerMunicipios($id);
		echo json_encode($municipios);
	}
}