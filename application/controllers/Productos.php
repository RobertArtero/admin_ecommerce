<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends MY_Controller
{


	public function index()
	{
		redirect("productos/listado");
	}

	public function listado()
	{

		$data = array();

		$data["total_eliminados"] = $this->__productos(true,1);

		$data["total"] = $this->__productos(true,0);

		$this->pagination->initialize($this->__paginacion(base_url('productos/listado'), $data["total"], $this->por_pagina));

		$data['productos'] = $this->__productos(false,0);

		$data["paginacion"] = $this->pagination->create_links();


		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/listado', $data);
		$this->load->view('base/footer');
	}

	public function eliminados()
	{

		$data = array();

		$data["total_eliminados"] = $this->__productos(true,1);

		$data["total"] = $this->__productos(true,1);

		$this->pagination->initialize($this->__paginacion(base_url('productos/eliminados'), $data["total"], $this->por_pagina));

		$data['productos'] = $this->__productos(false,1);

		$data["paginacion"] = $this->pagination->create_links();


		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/eliminados', $data);
		$this->load->view('base/footer');
	}

	public function ajax_crear_producto()
	{
		$nombre = $this->input->post("nombre");

		$producto = array(
			'nombre' => $nombre,
			'slug' => $this->__comprobar_slug($nombre)
		);

		$this->db->insert("productos", $producto);

		if ($this->db->affected_rows() > 0) {

			echo $this->db->insert_id();
		}
	}

	public function fcview()
	{
		echo FCPATH;
	}

	public function ver($id = 0)
	{

		$id = intval($id);

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			redirect(base_url("productos/listado"));
			return;
		}

		$data["producto"] = $producto->row();
		$data["categorias"] = $this->db->order_by("orden asc")->get_where("categorias", array(
			"activo" => 1
		))->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/ver', $data);
		$this->load->view('base/footer');
	}

	public function pedidos($id = 0)
	{

		$id = intval($id);

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			redirect(base_url("productos/listado"));
			return;
		}

		$data["total"] = $this->__pedidos($id, true);
		$data["producto"] = $producto->row();
		$data["pedidos"] = $this->__pedidos($id, false);

		$this->pagination->initialize($this->__paginacion(base_url('productos/pedidos/' . $id . "/"), $data["total"], $this->por_pagina,  4));
		$data["paginacion"] = $this->pagination->create_links();

		$data["facturacion"] = 0;
		$data["ventas"] = 0;

		foreach ($this->__calculo_venta_producto($id) as $cv) {
			$data["ventas"] += $cv->cantidad;
			$data["facturacion"] +=  $cv->cantidad * $cv->precio;
		}


		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/pedidos', $data);
		$this->load->view('base/footer');
	}

	public function seo($id = 0)
	{
		$id = intval($id);

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			redirect(base_url("productos/listado"));
			return;
		}

		$data["producto"] = $producto->row();
		$data["categorias"] = $this->db->order_by("orden asc")->get_where("categorias", array(
			"activo" => 1
		))->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/seo', $data);
		$this->load->view('base/footer');
	}

	public function precio($id = 0)
	{
		$id = intval($id);

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			redirect(base_url("productos/listado"));
			return;
		}

		$data["producto"] = $producto->row();
		$data["categorias"] = $this->db->order_by("orden asc")->get_where("categorias", array(
			"activo" => 1
		))->result();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('productos/precio', $data);
		$this->load->view('base/footer');
	}

	private function __calculo_venta_producto($id, $total = true)
	{

		$this->db->select("*");

		$this->db->from("pedidos");
		$this->db->join("pedidos_linea", "pedidos_linea.id_pedido = pedidos.id");

		$this->db->where("pedidos.activo", 1);
		$this->db->where("pedidos.pagado", 1);

		$this->db->where("pedidos_linea.id_producto", $id);



		$query = $this->db->get();

		return $query->result();
	}

	private function __pedidos($id, $total = true)
	{
		$this->db->select("*,pedidos.id as id_pedido, pedidos.nombre as nombre_cliente");
		$this->db->from("pedidos");
		$this->db->join("pedidos_linea", "pedidos_linea.id_pedido = pedidos.id");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("pedidos.id", $b);
			$this->db->or_like("pedidos.nombre", $b);
			$this->db->or_like("pedidos.telefono", $b);
			$this->db->or_like("pedidos.email", $b);

			$this->db->group_end();
		}

		$this->db->where("pedidos_linea.id_producto", $id);

		if ($this->input->get("filtrar_fecha") == "on") {
			if ($this->input->get("fecha_inicio") and $this->input->get("fecha_final")) {
				$this->db->group_start();

				$this->db->where('pedidos.fecha_entrega >=', $this->input->get("fecha_inicio"));
				$this->db->where('pedidos.fecha_entrega <=', $this->input->get("fecha_final"));

				$this->db->group_end();
			}
		}

		if (!$this->input->get("activo")) {
			$this->db->where("pedidos.activo", 1);
		}

		if (!$this->input->get("no_pagado")) {
			$this->db->where("pagado", 1);
		}


		if ($total) {
			return $this->db->count_all_results();
		} else {

			$this->db->order_by("pedidos.id DESC");

			if ($this->uri->segment(4) && ($this->uri->segment(4) != 0)) {
				$page = ($this->uri->segment(4));
			} else {
				$page = 1;
			}

			$per_page = $this->por_pagina;



			if ($per_page  != false || $page != false) {
				$offset = ($page - 1) * $per_page;
				$this->db->limit($per_page, $offset);
			}

			$query = $this->db->get();

			return $query->result();
		}
	}

	public function ajax_modificar()
	{

		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$nombre = strip_tags($this->input->post("nombre"));
		$descripcion = $this->input->post("descripcion");
		$alergeno = strip_tags($this->input->post("alergeno"));
		$orden = $this->input->post("orden");
		$precio = $this->input->post("precio");
		$estado_producto = $this->input->post("estado_producto");
		$imagen_principal = $this->input->post("imagen_principal");
		$categoria_principal = $this->input->post("categoria_principal");
		$mas_vendido = $this->input->post("mas_vendido");


		if (filter_var($estado_producto, FILTER_VALIDATE_BOOLEAN) == true) {
			$estado = 1;
		} else {
			$estado = 0;
		}

		if (filter_var($mas_vendido, FILTER_VALIDATE_BOOLEAN) == true) {
			$vendido = 1;
		} else {
			$vendido = 0;
		}

		$precio = str_replace(array("e", "-"), "", $precio);
		$precio  = str_replace(",", ".", $precio);

		$producto_r = $producto->row();

		if ($producto_r->fotografia != $imagen_principal and !empty($imagen_principal)) {
			copy(FCPATH . "uploads/" . $imagen_principal, $this->config->item('imagenes_tienda') . $imagen_principal);
		}

		$this->db->where("id", $id)->update("productos", array(

			"nombre" => $nombre,
			"descripcion" => $descripcion,
			"alergenos" => $alergeno,
			"precio" => $precio,
			"id_categoria" => $categoria_principal,
			"orden" => $orden,
			"precio" => $precio,
			"activo" => $estado,
			"fotografia" => $imagen_principal,
			"fecha_modificacion" => date("Y-m-d H:i:s"),
			"mas_vendido" => $vendido

		));



		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}
	}

	public function ajax_subir_imagen()
	{

		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la subida"));
			return false;
		}

		$check = getimagesize($_FILES["fichero"]["tmp_name"]);

		if ($check == false) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la subida del fichero, No es una imagen"));
			return false;
		}

		$file = $this->__slug(rand(0000, 9999) . "_" . $this->__remover_extension($_FILES["fichero"]['name']));


		$config['upload_path']          = FCPATH . 'uploads/';
		$config['allowed_types']        = '*';
		$config['file_name']            =  $file;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fichero')) {
			$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
			$file_name = $upload_data['file_name'];

			if (file_exists(FCPATH . "uploads/" . $file_name)) {
				echo json_encode(array(
					"result" => "success", "mensaje" => "Subida correctamente",
					"data" => array(
						"url" => base_url('uploads/') . $file_name,
						"fichero" => $file_name
					)
				));
				return false;
			} else {
				echo json_encode(array("result" => "error", "mensaje" => "Error en la subida"));
				return false;
			}
		} else {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la subida"));
			return false;
		}
	}

	public function ajax_modificar_seo()
	{

		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$slug = strip_tags($this->input->post("slug"));
		$meta_titulo = strip_tags($this->input->post("meta_titulo"));
		$meta_descripcion = strip_tags($this->input->post("meta_descripcion"));

		$this->db->where("id", $id)->update("productos", array(
			"slug" => $this->__comprobar_slug($slug),
			"meta_titulo" => $meta_titulo,
			"meta_descripcion" => $meta_descripcion
		));


		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}
	}

	public function ajax_modificar_precios()
	{

		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$precio = strip_tags($this->input->post("precio"));
		$precio_oferta = strip_tags($this->input->post("precio_oferta"));
		$precio_sin_iva = strip_tags($this->input->post("precio_sin_iva"));
		$precio_oferta_sin_iva = strip_tags($this->input->post("precio_oferta_sin_iva"));
		$oferta_activada = strip_tags($this->input->post("oferta_activada"));

		if (filter_var($oferta_activada, FILTER_VALIDATE_BOOLEAN) == true) {
			$oferta_activada = 1;
		} else {
			$oferta_activada = 0;
		}

		$this->db->where("id", $id)->update("productos", array(
			"precio" => $precio,
			"precio_oferta" => $precio_oferta,
			"precio_sin_iva" => $precio_sin_iva,
			"precio_oferta_sin_iva" => $precio_oferta_sin_iva,
			"oferta_activada" => $oferta_activada
		));


		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}
	}

	public function ajax_eliminar()
	{
		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$this->db->where("id", $id)->update("productos", array(
			"eliminado" => 1,
			"activo" => 0
		));
		
		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Eliminado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

	public function ajax_recuperar()
	{

		$id = intval($this->input->post("id"));

		$producto = $this->db->get_where("productos", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$this->db->where("id", $id)->update("productos", array(
			"eliminado" => 0
		));

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Eliminado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

	private function __productos($total = true, $eliminado)
	{
		$this->db->select("*");
		$this->db->from("productos");
		$this->db->where("eliminado", $eliminado);


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));
			$this->db->or_like("nombre", $b);
			$this->db->or_like("descripcion", $b);
			$this->db->group_end();
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

			if ($per_page  != false || $page != false) {
				$offset = ($page - 1) * $per_page;
				$this->db->limit($per_page, $offset);
			}

			$query = $this->db->get();
			return $query->result();
		}
	}

	public static function __slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicate -
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	private function __comprobar_slug($slug)
	{
		$slug_nuevo = $this->__slugify($slug);

		$query = $this->db->get_where('productos', array('slug' => $slug_nuevo));

		if($query->num_rows() == 0){
			return $slug_nuevo;
		}
		else{
			return $slug_nuevo.'-2';
		}


	}
}
