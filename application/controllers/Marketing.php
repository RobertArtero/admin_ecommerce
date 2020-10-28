<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends MY_Controller
{

	public function index()
	{
		redirect("marketing/cupones");
	}

	public function cupones()
	{

		$data = array();
		$data["total"] = $this->__cupones();
		$this->pagination->initialize($this->__paginacion(base_url('marketing/cupones'), $data["total"], $this->por_pagina));
		$data['cupones'] = $this->__cupones(false);
		$data["paginacion"] = $this->pagination->create_links();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('marketing/cupones', $data);
		$this->load->view('base/footer');

	}

	public function seguimiento()
	{

		$data = array();
		$data["total"] = $this->__mkt_seguimiento();
		$this->pagination->initialize($this->__paginacion(base_url('marketing/seguimiento'), $data["total"], $this->por_pagina));
		$data['seguimentos'] = $this->__mkt_seguimiento(false);
		$data["paginacion"] = $this->pagination->create_links();

		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('marketing/seguimiento', $data);
		$this->load->view('base/footer');

	}

	public function ajax_crear_cupon()
	{
		$cupon = array(
			'codigo'       => $this->input->post('codigo'),
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'tipo' => $this->input->post('tipo'),
			'descuento' => $this->input->post('descuento'),
			'fecha_inicio' => $this->input->post('fecha_inicio'),
			'fecha_final' => $this->input->post('fecha_final')
		);

		$this->db->insert('cupones', $cupon);

		$data['cupones'] = $this->db->get('cupones')->result();
		$html = $this->load->view('marketing/ajax/table-cupones',$data,TRUE);

		echo json_encode(array("result"=>"success","html" => $html));
		return false;
	}

	public function ajax_modal_cupon()
	{
		$id = $this->input->post('id');

		$cupon = $this->db->get_where('cupones',array('id' => $id),1)->row();

		if( !empty($cupon) ){
			$data['cupon'] = $cupon;
			$html = $this->load->view('marketing/ajax/modals/editar-cupon',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_editar_cupon()
	{
		$id = $this->input->post('id');

		$cupon = array(
			'codigo'       => $this->input->post('codigo'),
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'tipo' => $this->input->post('tipo'),
			'descuento' => $this->input->post('descuento'),
			'fecha_inicio' => $this->input->post('fecha_inicio'),
			'fecha_final' => $this->input->post('fecha_final')
		);

		$cupon_id = $this->db->get_where('cupones',array('id' => $id),1)->row();

		if( !empty($cupon_id) ){
			$this->db->where('id',$id)->update('cupones',$cupon);
			$data['cupones'] = $this->db->get('cupones')->result();
			$html = $this->load->view('marketing/ajax/table-cupones',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_eliminar_cupon(){

		$id = $this->input->post('id');

		$codigo_postal_id = $this->db->get_where('cupones',array('id' => $id),1)->row();

		if( !empty($codigo_postal_id) ){
			$this->db->where('id',$id)->delete('cupones');
			$data['cupones'] = $this->db->get('cupones')->result();
			$html = $this->load->view('marketing/ajax/table-cupones',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	private function __cupones($total = true)
	{
		$this->db->select("*");
		$this->db->from("cupones");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("codigo",$b);
			$this->db->or_like("nombre",$b);

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

	public function ajax_crear_seguimiento()
	{
		$seguimiento = array(
			'referencia'       => $this->input->post('referencia'),
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'medio' => $this->input->post('medio'),
			'utm_source' => $this->input->post('utm_source'),
			'utm_medium' => $this->input->post('utm_medium'),
			'utm_campaign' => $this->input->post('utm_campaign')
		);

		$this->db->insert('mkt_seguimiento', $seguimiento);

		$data['seguimentos'] = $this->__mkt_seguimiento(false);
		$html = $this->load->view('marketing/ajax/table-seguimientos',$data,TRUE);

		echo json_encode(array("result"=>"success","html" => $html));
		return false;
	}

	public function ajax_modal_seguimiento()
	{
		$id = $this->input->post('id');

		$seguimiento = $this->db->get_where('mkt_seguimiento',array('id' => $id),1)->row();

		if( !empty($seguimiento) ){
			$data['seguimiento'] = $seguimiento;
			$html = $this->load->view('marketing/ajax/modals/editar-seguimiento',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_editar_seguimiento()
	{
		$id = $this->input->post('id');

		$seguimiento = array(
			'referencia'       => $this->input->post('referencia'),
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'medio' => $this->input->post('medio'),
			'utm_source' => $this->input->post('utm_source'),
			'utm_medium' => $this->input->post('utm_medium'),
			'utm_campaign' => $this->input->post('utm_campaign')
		);

		$seguimiento_id = $this->db->get_where('mkt_seguimiento',array('id' => $id),1)->row();

		if( !empty($seguimiento_id) ){
			$this->db->where('id',$id)->update('mkt_seguimiento',$seguimiento);

			$data['seguimientos'] = $this->__mkt_seguimiento(false);
			$html = $this->load->view('marketing/ajax/table-seguimientos',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	public function ajax_eliminar_seguimiento(){

		$id = $this->input->post('id');

		$codigo_postal_id = $this->db->get_where('mkt_seguimiento',array('id' => $id),1)->row();

		if( !empty($codigo_postal_id) ){
			$this->db->where('id',$id)->delete('mkt_seguimiento');
			$data['cupones'] = $this->__mkt_seguimiento();
			$html = $this->load->view('marketing/ajax/table-cupones',$data,TRUE);
			echo json_encode(array("result"=>"success","html" => $html));
		}
	}

	private function __mkt_seguimiento($total = true)
	{
		$this->db->select("*");
		$this->db->from("mkt_seguimiento");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("referiencia",$b);
			$this->db->or_like("nombre",$b);

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
