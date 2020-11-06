<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __Construct(){
		parent::__Construct();
		$this->load->model('Models');
		$this->load->model('ClientesModel');

	}
	public function index()
	{
        
		if($this->session->userdata('is_logged')){
        $data['clientes'] = $this->ClientesModel->obtenerClientes();
		$this->load->view('admin/templates/__head');
		$this->load->view('admin/templates/__nav');
		$this->load->view('admin/clientes/clientes', $data);
		$this->load->view('admin/templates/__footer');

		}else{
			redirect('login');
		}
		
    }

    function agregarCliente(){
        if($this->session->userdata('is_logged')){
            $data['estados'] = $this->Models->obtenerEstados();

            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/clientes/agregarCliente',$data);
            $this->load->view('admin/templates/__footer');
    
        }else{
            redirect('login');
        }

    }

    function guardarCliente(){
        if($this->session->userdata('is_logged')){
            $rz = $this->input->post('razonSocial');
            $rfc = $this->input->post('rfc');
            $domicilio = $this->input->post('domicilio');
            $colonia = $this->input->post('colonia');
            $poblacion = $this->input->post('poblacion');
            $estado = $this->input->post('estado');
            $cp = $this->input->post('codigoPostal');
            $nombre = $this->input->post('nombreCliente');
            $puesto = $this->input->post('puesto');
            $telefono = join('',explode('-', $this->input->post('telefono')));
            $correo = $this->input->post('correo');

            if(!$query = $this->ClientesModel->agregarCliente($rz,$rfc,$domicilio,$colonia,$poblacion, $estado, $cp, $nombre,$puesto, $telefono, $correo)){
                echo json_encode(array("error"=>"Error, intenetalo mas tarde"));
            }else{
                echo json_encode(array("success"=>"Cliente agreagdo con exito"));
            }
        }else{
            redirect('login');
        }

    }

    function editarCliente($id){
        if($this->session->userdata('is_logged')){
            $data['estados'] = $this->Models->obtenerEstados();
            $data['clientes'] = $this->ClientesModel->obtenerClientesPorId($id);
            $this->load->view('admin/templates/__head');
            $this->load->view('admin/templates/__nav');
            $this->load->view('admin/clientes/editarCliente',$data);
            $this->load->view('admin/templates/__footer');
        }else{
            redirect('login');
        }

    }

    function guardarClienteEditado(){
        if($this->session->userdata('is_logged')){
             $rz = $this->input->post('razonSocial');
             $rfc = $this->input->post('rfc');
             $domicilio = $this->input->post('domicilio');
             $colonia = $this->input->post('colonia');
             $poblacion = $this->input->post('poblacion');
             $estado = $this->input->post('estado');
             $cp = $this->input->post('codigoPostal');
             $nombre = $this->input->post('nombreCliente');
             $puesto = $this->input->post('puesto');
             $telefono = join('',explode('-', $this->input->post('telefono')));
             $correo = $this->input->post('correo');
             $id = $this->input->post('id');

             if(!$query = $this->ClientesModel->editarCliente($rz,$rfc,$domicilio,$colonia,$poblacion, $estado, $cp, $nombre,$puesto, $telefono, $correo,$id)){
                 echo json_encode(array("error"=>"Error, intenetalo mas tarde"));
             }else{
                 echo json_encode(array("success"=>"Cliente editado con exito"));
             }
        }else{
            redirect('login');
        }

    }

    function eliminarCliente(){
        $postData = $this->input->post();
        if(!$sql = $this->ClientesModel->eliminarCliente($postData['id'])){
            echo json_encode(array('error' => 'ocurrio un error, intentalo mas tarde'));
        }else{
            echo json_encode(array('success' => 'cliente eliminado'));
        } 
    }


}   
    