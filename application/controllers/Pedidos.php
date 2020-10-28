<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends MY_Controller
{


	public function index()
	{
		redirect("pedidos/listado");
	}

	public function listado()
	{

		$data = array();

		$data["total"] = $this->__pedidos(true);

		$this->pagination->initialize($this->__paginacion(base_url('pedidos/listado'), $data["total"], $this->por_pagina));
		$data['pedidos'] = $this->__pedidos(false);
		$data["paginacion"] = $this->pagination->create_links();


		$data["hoy"] = $this->__cantidad_pedidos(date("Y-m-d"), date("Y-m-d"));
		$data["mes"] = $this->__cantidad_pedidos(date("Y-m-01"), date("Y-m-t"));
		$data["total_c"] = $this->__cantidad_pedidos();

		$data["total_facturacion_filtro"] = $this->__cantidad_pedidos_filtro();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/listado', $data);
		$this->load->view('base/footer');

	}


	public function ver($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/ver', $data);
		$this->load->view('base/footer');

	}

	public function pedido_pdf($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->library("pdfgenerator");
		//echo $view =  $this->load->view('pedidos/albaran',$data,true); exit();
		$this->pdfgenerator->generate($this->load->view('pedidos/albaran', $data, true));

	}

	public function descuentos($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/descuentos', $data);
		$this->load->view('base/footer');

	}

	public function pago($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/pago', $data);
		$this->load->view('base/footer');

	}

	public function avanzado($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/avanzado', $data);
		$this->load->view('base/footer');

	}


	public function shargo($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/shargo', $data);
		$this->load->view('base/footer');

	}

	public function cambiar_direccion($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}
		$pedido_row = $pedido->row();
		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();
		$data["direcciones_cliente"] = $this->db->get_where('clientes_direccion', array("id_usuario" => $pedido_row->id_usuario))->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/cambiar_direccion', $data);
		$this->load->view('base/footer');

	}

	public function editar_detalles_pedido($id = 0)
	{

		$id = intval($id);

		$pedido = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		$cliente = $this->db->get_where("clientes", array(
			"id" => $pedido->row()->id_usuario
		));

		if ($pedido->num_rows() == 0) {
			redirect(base_url("/pedidos"));
			return;
		}

		$data["pedido"] = $pedido->row();
		$data["cliente"] = $cliente->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('pedidos/editar_detalles_pedido', $data);
		$this->load->view('base/footer');

	}

	private function __cantidad_pedidos($fecha_inicio = "", $fecha_fin = "")
	{

		$this->db->select("count(*) as total_pedidos, sum(total_pedido) as total_facturacion");
		$this->db->from("pedidos");


		$this->db->where("activo", 1);
		$this->db->where("pagado", 1);


		if ($fecha_inicio != "" and $fecha_fin != "") {
			$this->db->where('fecha_entrega >=', $fecha_inicio . " 00:00:00");
			$this->db->where('fecha_entrega <=', $fecha_fin . " 23:59:00");
		}


		$r = $this->db->get();

		return $r->row();

	}

	private function __cantidad_pedidos_filtro($fecha_inicio = "", $fecha_fin = "")
	{

		$this->db->select("count(*) as total_pedidos, sum(total_pedido) as total_facturacion");
		$this->db->from("pedidos");

		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));
			$this->db->or_like("id", $b);
			$this->db->or_like("nombre", $b);
			$this->db->or_like("email", $b);
			$this->db->or_like("telefono", $b);
			$this->db->or_like("direccion", $b);
			$this->db->or_like("cp", $b);

			$this->db->group_end();

		}

		if ($this->input->get("fecha_inicio") and $this->input->get("fecha_final")) {
			$this->db->group_start();

			$this->db->where('fecha_entrega >=', $this->input->get("fecha_inicio"));
			$this->db->where('fecha_entrega <=', $this->input->get("fecha_final"));

			$this->db->group_end();


		}
		if (!$this->input->get("no_pagado")) {
			$this->db->where("pagado", 1);
		}

		if ($this->input->get("solo_activos")) {
			$this->db->where("activo", 1);
		}


		$r = $this->db->get();
		return $r->row();

	}

	private function __pedidos($total = true)
	{
		$this->db->select("*");
		$this->db->from("pedidos");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->like("id", $b);
			$this->db->or_like("nombre", $b);
			$this->db->or_like("email", $b);
			$this->db->or_like("telefono", $b);
			$this->db->or_like("direccion", $b);
			$this->db->or_like("cp", $b);

			$this->db->group_end();

		}

		if ($this->input->get("filtrar_fecha") == "on") {
			if ($this->input->get("fecha_inicio") and $this->input->get("fecha_final")) {
				$this->db->group_start();

				$this->db->where('fecha_entrega >=', $this->input->get("fecha_inicio"));
				$this->db->where('fecha_entrega <=', $this->input->get("fecha_final"));

				$this->db->group_end();
			}
		}

		if (!$this->input->get("no_pagado")) {
			$this->db->where("pagado", 1);
		}

		if ($this->input->get("solo_activos")) {
			$this->db->where("activo", 1);
		}


		if ($total) {
			return $this->db->count_all_results();
		} else {

			$this->db->order_by("id DESC");

			if ($this->uri->segment(3) && ($this->uri->segment(3) != 0)) {
				$page = ($this->uri->segment(3));
			} else {
				$page = 1;
			}

			$per_page = $this->por_pagina;

			if ($per_page != false || $page != false) {
				$offset = ($page - 1) * $per_page;
				$this->db->limit($per_page, $offset);
			}

			$query = $this->db->get();
			return $query->result();

		}
	}

	public function ajax_envio_shargo()
	{

		$id = intval($this->input->post("id"));

		$pedr = $this->db->get_where("pedidos", array(
			"id" => $id
		));
		if ($pedr->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}
		$pedido = $pedr->row(); //Obtengo el resultado del pedido

		$this->__envio_shargo($pedido);

		echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));

		return false;

	}

	public function ajax_editar_detalles()
	{

		$id = intval($this->input->post("id"));

		$nombre = strip_tags($this->input->post("nombre"));
		$telefono = strip_tags($this->input->post("telefono"));
		$fecha_entrega = strip_tags($this->input->post("fecha_entrega"));

		$pedr = $this->db->get_where("pedidos", array(
			"id" => $id
		));

		if ($pedr->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$pedido = $pedr->row(); //Obtengo el resultado del pedido

		if (strlen($nombre) == 0 or $nombre == "") {
			echo json_encode(array("result" => "error", "titulo" => "Error", "mensaje" => "El nombre no es correcto"));
			return false;
		}
		if (strlen($telefono) == 0 or $telefono == "" or !preg_match('/^[6798]{1}[0-9]{8}$/', $telefono)) {
			echo json_encode(array("result" => "error", "titulo" => "Error", "mensaje" => "El teléfono no es correcto"));
			return false;
		}

		$estado_pedido = $this->input->post("estado_pedido");

		if (filter_var($estado_pedido, FILTER_VALIDATE_BOOLEAN) == true) {
			$estado = 1;
		} else {
			$estado = 0;
		}


		$this->db->where("id", $pedido->id)->update("pedidos", array(
			"nombre" => $nombre,
			"telefono" => $telefono,
			"activo" => $estado,
			"fecha_entrega" => $fecha_entrega
		));

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;

		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;

		}


	}

	public function ajax_cambiar_direccion()
	{

		$id_pedido = $this->input->post('id');

		$id_nueva_direccion = $this->input->post('direccion');

		$clientes_direccion = $this->db->get_where('clientes_direccion', array('id' => $id_nueva_direccion))->row();

		$pedido = array(
			'direccion' => $clientes_direccion->direccion,
			'latitud' => $clientes_direccion->latitud,
			'longitud' => $clientes_direccion->longitud,
			'poblacion' => $clientes_direccion->poblacion,
			'provincia' => $clientes_direccion->provincia,
			'piso' => $clientes_direccion->piso
		);

		$this->db->where('id', $id_pedido)->update('pedidos', $pedido);

		if ($this->db->affected_rows() > 0) {
			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;

		} else {
			echo json_encode(array("result" => "error", "mensaje" => "Error, editar la dirección a fallado"));
			return false;

		}

	}

	public function ajax_activo()
	{
		$id = $this->input->post('id');
		$activo = $this->input->post('activo');

		$pedido = array(
			'activo' => $activo
		);

		$this->db->where('id', $id)->update('pedidos', $pedido);

		if ($this->db->affected_rows() > 0) {
			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;

		} else {
			echo json_encode(array("result" => "error", "mensaje" => "Error, editar la dirección a fallado"));
			return false;

		}
	}

}

?>
