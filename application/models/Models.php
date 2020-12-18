<?php
class Models extends CI_model
{
	
	 function __construct()
	{
		$this->load->database();
	}

	public function obtenerStatus(){
		$sql = $this->db->get('status');
		return $sql->result_array();
	}

	public function addLonche($producto_id,$cantidad,$precio){
		$datos = array('usuario_id' => $this->session->userdata('id'),
						'producto_id' => $producto_id,
						'cantidad' => $cantidad,
						'precio' => $precio,
						'total' => $precio * $cantidad);	
		$sql = $this->db->insert('lonche',$datos);
		if($sql){
			return true;
		}else
		return false;
	}

	function obtenerTiposdePago(){
		$sql = $this->db->get('tipos_pago');
		return $sql->result_array();
	}

	function obtenerPeriodosDePago(){
		$sql = $this->db->get('periodo_pago');
		return $sql->result_array();

	}

	function obtenerEstados(){
		$sql = $this->db->get('estados');
		return $sql->result_array();
	}


	/*------------------------------- P D F -------------------------------- */

	
	public function generatePdf($html){

		// Get output html
		$html = $this->output->get_output();
		// Load pdf library
		$this->load->library('pdf');
		// Load HTML content
		$this->dompdf->loadHtml($html);
	
		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'landscape');
	
		// Render the HTML as PDF
		$this->dompdf->render();
	
		// Output the generated PDF (1 = download and 0 = preview)
		$this->dompdf->stream("olv.pdf", array("Attachment"=>0));
	
	}

	public function generateOrdenCompra($html){

		// Get output html
		$html = $this->output->get_output();
		// Load pdf library
		$this->load->library('pdf');
		// Load HTML content
		$this->dompdf->loadHtml($html);
	
		// (Optional) Setup the paper size and orientation
		$this->dompdf->setPaper('A4', 'portrait');
	
		// Render the HTML as PDF
		$this->dompdf->render();
	
		// Output the generated PDF (1 = download and 0 = preview)
		$this->dompdf->stream("olv.pdf", array("Attachment"=>0));
	
	}

	

	

}