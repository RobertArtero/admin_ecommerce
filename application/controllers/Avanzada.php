<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avanzada extends MY_Controller
{

	public function index()
	{
		redirect("avanzada/general");
	}

	public function general()
	{
		$opciones_buscar = array('nombre_comercial', 'nombre_producto', 'meta_titulo', 'meta_descripcion', 'favicon', 'imagen_logo', 'nombre_fiscal', 'nif', 'direccion_comercial','email_terminos','contacto_telefono');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/ver', $data);
		$this->load->view('base/footer');
	}

	public function seguimiento()
	{
		$opciones_buscar = array('codigo_google', 'codigo_facebook');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/ver', $data);
		$this->load->view('base/footer');
	}

	public function envio()
	{
		$opciones_buscar = array('fecha_entrega', 'limitacion_cp','coste_envio_carrito','solicitar_calculo_codigo_postal');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/ver', $data);
		$this->load->view('base/footer');
	}

	public function paypal()
	{
		$opciones_buscar = array('paypal_test', 'paypal_email', 'paypal_moneda');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/pagos', $data);
		$this->load->view('base/footer');
	}

	public function redsys()
	{
		$opciones_buscar = array('redsys_fuc', 'redsys_terminal', 'redsys_moneda','redsys_trans','redsys_kc','redsys_url','redsys_test');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/pagos', $data);
		$this->load->view('base/footer');
	}

	public function metodos()
	{
		$data['metodos'] = $this->db->get('metodos_pago')->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/metodos_pago', $data);
		$this->load->view('base/footer');
	}

	public function whatsapp()
	{
		$opciones_buscar = array('whatsapp', 'whatsapp_telefono');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/ver', $data);
		$this->load->view('base/footer');
	}

	public function notificaciones()
	{
		$opciones_buscar = array('email_notificaciones');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/ver', $data);
		$this->load->view('base/footer');
	}

	public function personalizacion()
	{
		$opciones_buscar = array('color_primario', 'color_secundario','color_sombra','color_hipervinculo','color_hover','color_border_menu','color_precio','color_primario_boton','color_secundario_boton');

		$opciones = array();

		foreach ($opciones_buscar as $opcion_buscar){
			$get = $this->db->get_where('opciones', array('opcion' => $opcion_buscar),1)->row();
			array_push($opciones, $get);
		}

		$data['opciones'] = $opciones;

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion_avanzada/personalizacion', $data);
		$this->load->view('base/footer');
	}

	public function editar_input(){

		$id = $this->input->post('id');
		$valor = $this->input->post('val');

		$opciones = array(
			'valor' => $valor
		);

		$this->db->where('id', $id)->update('opciones', $opciones);

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

	public function editar_activo(){

		$id = $this->input->post('id');
		$activo = $this->input->post('activo');

		if (filter_var($activo, FILTER_VALIDATE_BOOLEAN) == true) {
			$activo = 1;
		} else {
			$activo = 0;
		}

		$opciones = array(
			'activo' => $activo
		);

		$this->db->where('id', $id)->update('opciones', $opciones);

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

	public function editar_activo_metodos(){

		$id = $this->input->post('id');
		$activo = $this->input->post('activo');

		if (filter_var($activo, FILTER_VALIDATE_BOOLEAN) == true) {
			$activo = 1;
		} else {
			$activo = 0;
		}

		$metodos = array(
			'activo' => $activo
		);

		$this->db->where('id', $id)->update('metodos_pago', $metodos);

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

}
?>
