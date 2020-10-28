<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller
{

	public function index(){

		redirect("pedidos");
		return;

		$data = array();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('panel');
		$this->load->view('base/footer');


	}

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect( base_url() );
	}


}
?>
