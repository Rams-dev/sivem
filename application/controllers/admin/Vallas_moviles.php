<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vallas_moviles extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('MaterialesModel');
		$this->load->model('MediosModel');
		$this->load->model('Vallas_movilesModel');
		$this->load->model('PropietariosModel');
		$this->load->model('ClientesModel');
        $this->load->model('EspectacularesModel');
        $this->load->model('Vallas_fijasModel');
		$this->load->library('image_lib');
        

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
            $data['vallas_moviles'] = $this->Vallas_movilesModel->obtenerVallas_moviles();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_moviles/vallas_moviles',$data);
            $this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}
    }

    public function agregarValla_movil(){
        if($this->session->userdata('is_logged')){
            $data['materiales'] = $this->MaterialesModel->obtenerMateriales();
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_moviles/agregarValla_movil',$data);
            $this->load->view('admin/templates/__footer');
        }else{
            redirect("login");
        }
    }

    public function guardarValla_movil(){
        if($this->session->userdata('is_logged')){

            $nocontrol = $this->input->post('nocontrol');
            $marca = $this->input->post('marca');
            $modelo = $this->input->post('modelo');
            $anio = $this->input->post('anio');
            $status = $this->input->post('status');

            $fechaInicioOcupacion ="";
            $fechaTerminoOcupacion ="";
    
            if($status == "APARTADO"){
                $fechaInicioOcupacion = $this->input->post("inicioOcupacion");
                $fechaTerminoOcupacion = $this->input->post("terminoOcupacion");
            }elseif($status == "OCUPADO"){
                $fechaTerminoOcupacion = $this->input->post("terminoOcupacion");
            }

            $anchoLateral = $this->input->post('anchoLateral');
            $altoLateral = $this->input->post('altoLateral');
            $materialLateral = $this->input->post('materialLateral');
            $anchoFaldon = $this->input->post('anchoFaldon');
            $altoFaldon = $this->input->post('altoFaldon');
            $materialFaldon = $this->input->post('materialFaldon');
            $anchoPuerta = $this->input->post('anchoPuerta');
            $altoPuerta = $this->input->post('altoPuerta');
            $materialPuerta = $this->input->post('materialPuerta');
            $anchoFrente = $this->input->post('anchoFrente');
            $altoFrente = $this->input->post('altoFrente');
            $materialFrente = $this->input->post('materialFrente');
            $r = $this->input->post('renta');
            $renta = trim(str_replace("$","",$r));
            $costoImpresion = $this->input->post('costoImpresion');
            $costoTotal = $this->input->post('costoTotal');
            $observaciones = $this->input->post('observaciones');
            $acabados = $this->input->post('acabados');
            // $l = $this->input->post();
            //  echo json_encode($anchoFaldon);
            //  exit;
            // echo json_encode(array($nocontrol,$marca,$modelo,$anio,$costo,$costo,$acabados,$anchoLateral,$altoLateral,$materialLateral,$anchoFaldon,$altoFaldon,$materialFaldon,$anchoPuerta,$altoPuerta,$materialPuerta,$anchoFrente,$altoFrente,$materialFrente,$observaciones,$acabados));


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

            if(!$id_medio = $this->MediosModel->agregarMedio($status,$costoTotal,$tipo_medio ="Vallas movil",$fechaInicioOcupacion,$fechaTerminoOcupacion)){
                echo json_encode(array("error" => "Error, no se pudo Agregar medio"));
                unlink('assets/images/medios'.$imagen1);
                unlink('assets/images/medios'.$imagen2);
                unlink('assets/images/medios'.$imagen3);
                exit;
            }
            
            if($VM = $this->Vallas_movilesModel->agregar($nocontrol,$id_medio,$marca,$modelo,$anio,$acabados,$anchoLateral,$altoLateral,$materialLateral,$anchoFaldon,$altoFaldon,$materialFaldon,$anchoPuerta,$altoPuerta,$materialPuerta,$anchoFrente,$altoFrente,$materialFrente,$costoImpresion,$renta,$observaciones,$imagen1,$imagen2,$imagen3)){
                echo json_encode(array("success" => "Valla agregada correctamente"));
            }else{
                echo json_encode(array("error" => "Ha ocurrido un error"));
            }
        }else{
            redirect("login");
        }
    }


    public function obtenerImagenesVallasMovilesPorId($id){
        if($this->session->userdata('is_logged')){
            if(!$data = $this->Vallas_movilesModel->obtenerImagenesVallasMovilesPorId($id)){
                echo json_encode(array("error" => "datos no encontrados"));
                exit;
            }
            else{
                echo json_encode($data);
            } 
        }else{
            redirect("login");
        }
    }

    function eliminarValla(){
        if($this->session->userdata('is_logged')){
            $id = $this->input->post();
            $valla_movil = $this->Vallas_movilesModel->obtenerVallas_movilesPorIdMedio($id['id_medio']);
            foreach($valla_movil as $valla){
                unlink("assets/images/medios/". $valla['vista_corta']);
                unlink("assets/images/medios/". $valla['vista_media']);
                unlink("assets/images/medios/". $valla['vista_larga']);
              }
            if(!$this->MediosModel->eliminarMedio($id['id_medio'])){
                echo json_encode(array("error" => "No se pudo eliminar el medio"));
                exit;

            }
            if($data = $this->Vallas_movilesModel->eliminarValla($id['id_medio'])){
                echo json_encode(array("success" => "Valla eliminada"));
            }else{
                echo json_encode(array("error" => "Error al eliminar la valla"));
            }
        }else{
            redirect("login");
        }

    }


    public function editarValla_movil($id_medio){
        if($this->session->userdata('is_logged')){
            $data['materiales'] = $this->MaterialesModel->obtenerMateriales();
            $data['vallas_moviles'] = $this->Vallas_movilesModel->obtenerValla_movilPorId($id_medio);
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/vallas_moviles/editarValla_movil',$data);
            $this->load->view('admin/templates/__footer');
		}else{
			redirect('login');
		}

    }

    public function guardarValla_movilEditado(){
        $id_medio = $this->input->post('id_medio');
        $nocontrol = $this->input->post('nocontrol');
        $marca = $this->input->post('marca');
        $modelo = $this->input->post('modelo');
        $anio = $this->input->post('anio');
        $status = $this->input->post('status');
       

        $anchoLateral = $this->input->post('anchoLateral');
        $altoLateral = $this->input->post('altoLateral');
        $materialLateral = $this->input->post('materialLateral');
        $anchoFaldon = $this->input->post('anchoFaldon');
        $altoFaldon = $this->input->post('altoFaldon');
        $materialFaldon = $this->input->post('materialFaldon');
        $anchoPuerta = $this->input->post('anchoPuerta');
        $altoPuerta = $this->input->post('altoPuerta');
        $materialPuerta = $this->input->post('materialPuerta');
        $anchoFrente = $this->input->post('anchoFrente');
        $altoFrente = $this->input->post('altoFrente');
        $materialFrente = $this->input->post('materialFrente');
        $r = $this->input->post('renta');
        $renta = trim(str_replace("$","",$r));
        $ci = $this->input->post('costoImpresion');
        $costoImpresion = trim(str_replace("$","",$ci)); 
        $ct = $this->input->post('costoTotal');
        $costoTotal = trim(str_replace("$","",$ct));
        $observaciones = $this->input->post('observaciones');
        $acabados = $this->input->post('acabados');
        // echo json_encode($costoImpresion);
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

        $vallas_moviles = $this->Vallas_movilesModel->obtenerValla_movilPorId($id_medio);
        //  var_dump($vallas_fijas);
        //  exit;

        foreach($vallas_moviles as $vallas){
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


        if(!$medioEditado = $this->MediosModel->guardarCambiosMedio($id_medio,$costoTotal,$status)){
            echo json_encode(array("error" => "Ha ocurrido un error al hacer cambios con el medio"));
            exit;
        }
        if($VMEditado = $this->Vallas_movilesModel->guardarCambiosValla_movli($id_medio,$nocontrol,$marca,$modelo,$anio,$acabados,$anchoLateral,$altoLateral,$materialLateral,$anchoFaldon,$altoFaldon,$materialFaldon,$anchoPuerta,$altoPuerta,$materialPuerta,$anchoFrente,$altoFrente,$materialFrente,$costoImpresion,$renta,$observaciones,$imagen1,$imagen2,$imagen3)){
            echo json_encode(array("success" => "Cambios guardados correctamente"));
        }else{
            echo json_encode(array("error" => "Ha ocurrido un error al modificar la valla movil"));
        }
 
        // $formData = $this->input->post();
        // echo json_encode($formData);
    }

}