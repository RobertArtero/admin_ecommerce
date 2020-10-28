<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paginas extends MY_Controller
{

	public function index()
	{
		redirect("paginas/listado");
	}

	public function listado()
	{

		$data = array();

		$data["total"] = $this->__paginas(true);

		$this->pagination->initialize($this->__paginacion(base_url('paginas/listado'), $data["total"], $this->por_pagina));

		$data['paginas'] = $this->__paginas(false);

		$data["paginacion"] = $this->pagination->create_links();


		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('paginas/listado', $data);
		$this->load->view('base/footer');
	}

	public function ver($id = 0)
	{

		$id = intval($id);

		$pagina = $this->db->get_where("paginas", array(
			"id" => $id
		));

		if ($pagina->num_rows() == 0) {
			redirect(base_url("productos/listado"));
			return;
		}

		$data["pagina"] = $pagina->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('paginas/ver', $data);
		$this->load->view('base/footer');
	}

	public function seo($id = 0)
	{
		$id = intval($id);

		$producto = $this->db->get_where("paginas", array(
			"id" => $id
		));

		if ($producto->num_rows() == 0) {
			redirect(base_url("paginas/listado"));
			return;
		}

		$data["pagina"] = $producto->row();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('paginas/seo', $data);
		$this->load->view('base/footer');
	}

	public function ajax_crear_pagina()
	{
		$titulo = $this->input->post("titulo");

		$paginas = array(
			'titulo' => $titulo,
			'slug' => $this->__comprobar_slug($titulo)
		);

		$this->db->insert("paginas", $paginas);

		if ($this->db->affected_rows() > 0) {
			echo $this->db->insert_id();
		}
	}

	public function ajax_modificar()
	{

		$id = intval($this->input->post("id"));

		$pagina = $this->db->get_where("paginas", array(
			"id" => $id
		));

		if ($pagina->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$titulo = strip_tags($this->input->post("titulo"));
		$contenido = $this->input->post("contenido");
		$activo = $this->input->post("activo");

		if (filter_var($activo, FILTER_VALIDATE_BOOLEAN) == true) {
			$activo = 1;
		} else {
			$activo = 0;
		}


		$this->db->where("id", $id)->update("paginas", array(

			"titulo" => $titulo,
			"contenido" => $contenido,
			"activo" => $activo
		));

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}
	}

	public function ajax_modificar_seo()
	{

		$id = intval($this->input->post("id"));

		$pagina = $this->db->get_where("paginas", array(
			"id" => $id
		));

		if ($pagina->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$slug = strip_tags($this->input->post("slug"));
		$meta_titulo = strip_tags($this->input->post("meta_titulo"));
		$meta_descripcion = strip_tags($this->input->post("meta_descripcion"));

		$pagina = array(
			"slug" => $this->__comprobar_slug($slug),
			"meta_titulo" => $meta_titulo,
			"meta_descripcion" => $meta_descripcion
		);

		$this->db->where("id", $id)->update("paginas", $pagina);


		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}
	}

	public function ajax_eliminar(){

		$id = intval($this->input->post("id"));

		$pagina = $this->db->get_where("paginas", array(
			"id" => $id
		));

		if ($pagina->num_rows() == 0) {
			echo json_encode(array("result" => "error", "mensaje" => "Error en la actualización"));
			return false;
		}

		$this->db->where('id', $id)->delete('paginas');

		if ($this->db->affected_rows() > 0) {

			echo json_encode(array("result" => "success", "mensaje" => "Modificado correctamente"));
			return false;
		} else {

			echo json_encode(array("result" => "error", "mensaje" => "Error, los datos son los mismos."));
			return false;
		}

	}

	private function __paginas($total = true)
	{
		$this->db->select("*");
		$this->db->from("paginas");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));
			$this->db->or_like("titulo", $b);
			$this->db->or_like("slug", $b);
			$this->db->group_end();
		}

		if ($total) {
			return $this->db->count_all_results();
		} else {

			$this->db->order_by("id ASC");

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

	private function __slugify($text)
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

		$query = $this->db->get_where('paginas', array('slug' => $slug_nuevo));

		if($query->num_rows() == 0){
			return $slug_nuevo;
		}
		else{
			return $slug_nuevo.'-2';
		}


	}

}
