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
		$data['status'] = $this->Models->obtenerStatus();
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
			 $observaciones = $this->input->post('observaciones');
			 $acabados = $this->input->post('acabados');
			 $iniciocontrato = $this->input->post('iniciocontrato');
			 $fincontrato = $this->input->post('fincontrato');
			 $monto = $this->input->post('monto');
			 $folio = $this->input->post('folio');
			 $tipopago = $this->input->post('tipopago');
			 $periodopago = $this->input->post('periodopago');


			$config['upload_path'] = "./assets/images/espectaculares";
			$config['allowed_types'] = "*";       	
			$this->load->library('upload', $config);

			if($this->upload->do_upload('imagen1')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$this->upload->do_upload('imagen1');
				$imagen1 = $data['upload_data']['file_name'];
			}else{
				echo json_encode("no se subio la imagen1");

			}
				

			if($this->upload->do_upload('imagen2')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$this->upload->do_upload('imagen2');
				$imagen2 = $data['upload_data']['file_name'];

			}else{
				echo json_encode("no se subio la imagen2");

			}

			if($this->upload->do_upload('imagen3')) {
				$data['uploadSuccess'] = $this->upload->data();
				$data = array('upload_data' => $this->upload->data());
				$this->upload->do_upload('imagen3');
				$imagen3 = $data['upload_data']['file_name'];

			}else{

				echo json_encode("no se subio la imagen3");
			}

			/* datos del propietario */
			$nombreprop = $this->input->post('nombreprop');
			$celular = intval(join('', explode('-',$this->input->post('celular'))));
			$telefono = intval(join('', explode('-',$this->input->post('telefono'))));


			if(!$id_medio= $this->MediosModel->agregarMedio($status,$precio,$tipo_medio = "Espectacular")){
				echo json_encode(array('error' => 'no se pudo registrar el medio.'));
				exit;
			}else{	
				if(!$idProp = $this->PropietariosModel->agregarPropietarioEspectacular($nombreprop,$celular,$telefono)){
					echo json_encode(array('error', 'Fallo al agregar el espectacular'));
				}else{
				var_dump($idProp);
					
					if(!$sql = $this->EspectacularesModel->agregarEspectacular( 
						$id_medio,
						$ncontrol,
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
			 $idEspectacular = $this->input->post();
			 
			 $espectacular = $this->EspectacularesModel->obtenerEspectaculares($idEspectacular['id']);

			 foreach($espectacular as $esp){
				 unlink("assets/images/espectaculares/". $esp['vista_larga']);
			 }

			 if(!$datos = $this->EspectacularesModel->eliminarEspectacular($idEspectacular['id'])){
			 	 echo json_encode(array('error', 'lo siento no se pudde eliminar el especatular, intentalo mas tarde'));
			  }else{
				  echo json_encode(array('success', 'Espectacular eliminado'));
			  }

	 	}else{
	 		redirect('login');
	 	}
	 }

	 function editarEspectacular($id){
		 if($this->session->userdata('is_logged')){
			$data['espectaculares'] = $this->EspectacularesModel->obtenerEspectacularesPorId($id);
			$data['status'] = $this->Models->obtenerStatus();
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
			
		 	$id = $this->input->post('id');
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
		 	$ancho = $this->input->post('ancho');
		 	$alto = $this->input->post('alto');
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
			// echo json_encode($formData);
			// exit;
    	    $config['upload_path'] = "./assets/images/espectaculares";
		    $config['allowed_types'] = "*";       	
		    $this->load->library('upload', $config);

		    if($this->upload->do_upload('imagen1')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
			   $data = array('upload_data' => $this->upload->data());
		 	   $this->upload->do_upload('imagen1');
		 	   $imagen1 = $data['upload_data']['file_name'];
		    }else{
		 	   echo json_encode("no se subio la imagen1");

		    }
			   

		    if($this->upload->do_upload('imagen2')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
		 	   $data = array('upload_data' => $this->upload->data());
		 	   $this->upload->do_upload('imagen2');
		 	   $imagen2 = $data['upload_data']['file_name'];

		    }else{
		 	   echo json_encode("no se subio la imagen2");

		    }

		    if($this->upload->do_upload('imagen3')) {
		 	   $data['uploadSuccess'] = $this->upload->data();
		 	   $data = array('upload_data' => $this->upload->data());
		 	   $this->upload->do_upload('imagen3');
		 	   $imagen3 = $data['upload_data']['file_name'];

		    }else{

		 	   echo json_encode("no se subio la imagen3");
			}
			
			/*----------------- datos de medio------------ */
			$medio_id = $this->input->post('id_medio');
			$precio = $this->input->post('precio');
			$status = $this->input->post('status');

			if(!$edMedio = $this->MediosModel->guardarCambiosMedio($medio_id,$precio,$status)){
				echo json_encode(array('error'=>' no se pudeo editar el medio'));
				exit;
			}

		   /* datos del propietario */
			$id_prop = $this->input->post('id_prop');
		   $nombreprop = $this->input->post('nombreprop');
		   $celular = intval(join('', explode('-',$this->input->post('celular'))));
		   $telefono = intval(join('', explode('-',$this->input->post('telefono'))));


		   if(!$edProp = $this->PropietariosModel->editarPropietarioEspectacular($id_prop, $nombreprop,$celular,$telefono)){
			   echo json_encode(array('error', 'Fallo al agregar el espectacular'));
		   }
		

			if(!$sql = $this->EspectacularesModel->editarEspectacular( 
				$id,
				$ncontrol,
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
				$folio,
				$tipopago,
				$periodopago,
				$imagen1,
				$imagen2,
				$imagen3)){
				   echo json_encode(array('error' => 'No se edito el espectacular, intenta mas tarde'));	
		   }else{
					echo json_encode(array('success' => 'Espectacular editado'));
		   }
		}else{
			redirect('login');
		}
	}
}