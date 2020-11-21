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
        

	}
	public function index()
	{
		if($this->session->userdata('is_logged')){
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/vallas_fijas/vallas_fijas');
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
            $costoimpresion = substr($this->input->post("costodeimpresion"),2);
            $costoinstalacion = substr($this->input->post("costodeinstalacion"),2);
            $precio = substr($this->input->post("precio"),2);
            $status = $this->input->post("status");
            $observaciones = $this->input->post("observaciones");
            $acabados = $this->input->post("acabados");
            $propietario = $this->input->post("propietario");
            if($propietario == "nuevo"){
                $nombreprop = $this->input->post("nombreprop");
                $celular = $this->input->post("celular");
                $telefono = $this->input->post("telefono");
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

			$config['upload_path'] = "./assets/images/vallas_fijas";
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


            // echo json_encode(array($status,$precio,$tipo_medio ="valla_fija"));
            if(!$id_medio = $this->MediosModel->agregarMedio($status,$precio,$tipo_medio ="valla_fija")){
                echo json_encode(array("error" => "Intenta mas tarde"));
            }else{
                if($propietario == "nuevo"){
                    if(!$id_prop = $this->PropietariosModel->agregarPropietarioEspectacular($nombreprop,$telefono,$celular)){
                        echo json_encode(array("error" => "Error intenta mas tarde"));
                        $this->MediosModel->eliminarMedio($id_medio);
                        exit;
                    }
                }else{
                    $id_prop = $idprop;
                }

                if($this->Vallas_fijasModel->agregarValla_fija($numcontrol,$costoimpresion,$costoinstalacion,$calle,$numero,$colonia,$localidad,$municipio,$estado,$latitud,$longitud,$referencias,$ancho,$alto,$material,$observaciones,$acabados,$imagen1,$imagen2,$imagen3,$id_prop,$id_medio,$iniciocontrato,$fincontrato,$tipopago,$periodo,$monto)){
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

    public function editaValla_fija($id){
        if($this->session->userdata('is_logged')){
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

}