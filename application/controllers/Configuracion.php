<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends MY_Controller
{

	public function index()
	{
		redirect("configuracion/categorias");
	}

	public function categorias()
	{

		$data = array();
		$data["total"] = $this->__categorias();
		$this->pagination->initialize($this->__paginacion(base_url('configuracion/categorias'), $data["total"], $this->por_pagina));
		$data['categorias'] = $this->__categorias(false);
		$data["paginacion"] = $this->pagination->create_links();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion/categorias', $data);
		$this->load->view('base/footer');

	}

	public function codigos_postales()
	{

		$data = array();
		$data["total"] = $this->__cp();
		$this->pagination->initialize($this->__paginacion(base_url('configuracion/codigos_postales'), $data["total"], $this->por_pagina));
		$data['codigos_postales'] = $this->__cp(false);
		$data["paginacion"] = $this->pagination->create_links();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion/codigos-postales', $data);
		$this->load->view('base/footer');

	}

	public function administradores()
	{

		$data = array();
		$data["total"] = $this->__administradores();
		$this->pagination->initialize($this->__paginacion(base_url('configuracion/administradores'), $data["total"], $this->por_pagina));
		$data['administradores'] = $this->__administradores(false);
		$data["paginacion"] = $this->pagination->create_links();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('configuracion/administradores', $data);
		$this->load->view('base/footer');

	}

	public function ajax_crear_administrador()
	{
		$administrador = array(
			'nombre'       => $this->input->post('nombre'),
			'email'       => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'activo' => $this->input->post('activo')
		);

		$this->db->insert('administradores', $administrador);

		$data['administradores'] = $this->__administradores(false);
		$html = $this->load->view('configuracion/ajax/table-administradores',$data,TRUE);

		echo json_encode(array("result"=>"success","html" => $html));
		return false;
	}

	public function ajax_modal_administrador()
	{
		$id = $this->input->post('id');

		$administrador = $this->db->get_where('administradores',array('id' => $id),1)->row();

		if( !empty($administrador) ){
			$data['administrador'] = $administrador;
			$html = $this->load->view('configuracion/ajax/modals/editar-administrador',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_editar_administrador()
	{
		$id = $this->input->post('id');

		$administrador = array(
			'nombre'       => $this->input->post('nombre'),
			'email'       => $this->input->post('email'),
			'activo' => $this->input->post('activo')
		);

		$administrador_id = $this->db->get_where('administradores',array('id' => $id),1)->row();

		if( !empty($administrador_id) ){
			$this->db->where('id',$id)->update('administradores',$administrador);
			$data['administradores'] = $this->__administradores(false);
			$html = $this->load->view('configuracion/ajax/table-administradores',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_password_administrador()
	{
		$id = $this->input->post('id');

		$administrador = array(
			'password' => $this->input->post('password')
		);

		$administrador_id = $this->db->get_where('administradores',array('id' => $id),1)->row();

		if( !empty($administrador_id) ){
			$this->db->where('id',$id)->update('administradores',$administrador);
			$data['administradores'] = $this->__administradores(false);
			$html = $this->load->view('configuracion/ajax/table-administradores',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_eliminar_administrador(){

		$id = $this->input->post('id');

		$codigo_postal_id = $this->db->get_where('administradores',array('id' => $id),1)->row();

		if( !empty($codigo_postal_id) ){
			$this->db->where('id',$id)->delete('administradores');
			$data['administradores'] = $this->__administradores(false);
			$html = $this->load->view('configuracion/ajax/table-administradores',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	private function __administradores($total = true)
	{
		$this->db->select("*");
		$this->db->from("administradores");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("email",$b);
			$this->db->or_like("nombre",$b);

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

	public function ajax_crear_categoria()
	{
		$categoria = array(
			'nombre'       => $this->input->post('nombre'),
			'descripcion'    => $this->input->post('descripcion'),
			'activo' => $this->input->post('activo'),
			'id_padre' => $this->input->post('id_padre')
		);

		$this->db->insert('categorias', $categoria);

		$data['categorias'] = $this->db->get('categorias')->result();
		$html = $this->load->view('configuracion/ajax/table-categorias',$data,TRUE);

		echo json_encode(array("result"=>"success","html" => $html));
		return false;
	}

	public function ajax_modal_categoria()
	{
		$id = $this->input->post('id');

		$categoria = $this->db->get_where('categorias',array('id' => $id),1)->row();

		if( !empty($categoria) ){
			$data['categoria'] = $categoria;
			$data['categorias'] = $this->__categorias(false);
			$html = $this->load->view('configuracion/ajax/modals/editar-categoria',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_editar_categoria()
	{
		$id = $this->input->post('id');

		$categoria = array(
			'nombre'       => $this->input->post('nombre'),
			'descripcion'    => $this->input->post('descripcion'),
			'id_padre' => $this->input->post('id_padre'),
			'activo' => $this->input->post('activo')
		);

		$categoria_id = $this->db->get_where('categorias',array('id' => $id),1)->row();

		if( !empty($categoria_id) ){
			$this->db->where('id',$id)->update('categorias',$categoria);
			$data['categorias'] = $this->db->get('categorias')->result();
			$html = $this->load->view('configuracion/ajax/table-categorias',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	private function __categorias($total = true)
	{
		$this->db->select("*");
		$this->db->from("categorias");

		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("id",$b);
			$this->db->or_like("nombre",$b);

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

	public function ajax_crear_cp()
	{
		$codigo_postal = array(
			'codigo_postal'       => $this->input->post('codigo_postal'),
			'activo' => $this->input->post('activo')
		);

		$this->db->insert('codigo_postal', $codigo_postal);

		$data['codigos_postales'] = $this->db->get('codigo_postal')->result();
		$html = $this->load->view('configuracion/ajax/table-codigos-postales',$data,TRUE);

		echo json_encode(array("result"=>"success","html" => $html));
		return false;
	}

	public function ajax_modal_cp()
	{
		$id = $this->input->post('id');

		$categoria = $this->db->get_where('codigo_postal',array('id' => $id),1)->row();

		if( !empty($categoria) ){
			$data['codigo_postal'] = $categoria;
			$html = $this->load->view('configuracion/ajax/modals/editar-codigo-postal',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_editar_cp()
	{
		$id = $this->input->post('id');

		$codigo_postal = array(
			'codigo_postal'       => $this->input->post('codigo_postal'),
			'activo' => $this->input->post('activo')
		);

		$codigo_postal_id = $this->db->get_where('codigo_postal',array('id' => $id),1)->row();

		if( !empty($codigo_postal_id) ){
			$this->db->where('id',$id)->update('codigo_postal',$codigo_postal);
			$data['codigos_postales'] = $this->db->get('codigo_postal')->result();
			$html = $this->load->view('configuracion/ajax/table-codigos-postales',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_eliminar_cp(){

		$id = $this->input->post('id');

		$codigo_postal_id = $this->db->get_where('codigo_postal',array('id' => $id),1)->row();

		if( !empty($codigo_postal_id) ){
			$this->db->where('id',$id)->delete('codigo_postal');
			$data['codigos_postales'] = $this->db->get('codigo_postal')->result();
			$html = $this->load->view('configuracion/ajax/table-codigos-postales',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	private function __cp($total = true)
	{
		$this->db->select("*");
		$this->db->from("codigo_postal");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("id",$b);
			$this->db->or_like("codigo_postal",$b);

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


}
?>
