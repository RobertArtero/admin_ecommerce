<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller
{

	public function index()
	{
		redirect("clientes/listado");
	}

	public function listado()
	{

		$data = array();

		$data["total"] = $this->__clientes();
		$this->pagination->initialize($this->__paginacion(base_url('clientes/listado'), $data["total"], $this->por_pagina));
		$data['clientes'] = $this->__clientes(false);
		$data["paginacion"] = $this->pagination->create_links();


		$this->load->view('base/header', $data);
		$this->load->view('base/menu', $data);
		$this->load->view('clientes/listado', $data);
		$this->load->view('base/footer');

	}

	public function ver($id = 0){

		$id = intval ($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["cliente"] = $clientes->row();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/ver',$data);
		$this->load->view('base/footer');

	}

	public function direcciones($id = 0){

		$id = intval ($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		$direcciones = $this->db->get_where("clientes_direccion",array(
			"id_usuario" => $id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["cliente"] = $clientes->row();
		$data["direcciones"] = $direcciones->result();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/direcciones',$data);
		$this->load->view('base/footer');

	}

	public function editar_cliente($id = 0){


		$id = intval ($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["cliente"] = $clientes->row();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/editar_detalles_cliente',$data);
		$this->load->view('base/footer');


	}

	public function pedidos($id = 0){

		$id = intval($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["total"] = $this->__pedidos($id,true);

		$data["cliente"] = $clientes->row();

		$this->pagination->initialize($this->__paginacion(base_url('clientes/pedidos/' . $id . "/"), $data["total"], $this->por_pagina, 4));
		$data['pedidos'] = $this->__pedidos($id,false);
		$data["paginacion"] = $this->pagination->create_links();

		$data["hoy"] = $this->__cantidad_pedidos($id,date("Y-m-d"),date("Y-m-d"));
		$data["mes"] = $this->__cantidad_pedidos($id,date("Y-m-01"),date("Y-m-t"));
		$data["total_c"] = $this->__cantidad_pedidos($id);

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/pedidos',$data);
		$this->load->view('base/footer');

	}

	public function guardar_direccion($id = 0){

		$id = intval ($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["cliente"] = $clientes->row();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/guardar_direccion',$data);
		$this->load->view('base/footer');

	}

	public function monedero($id = 0){

		$id = intval ($id);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		$monedero = $this->db->order_by("id","desc")->get_where("clientes_saldo_movimiento",array(
			"id_usuario" => $id
		));

		if($clientes->num_rows() == 0){
			redirect(base_url("/clientes"));
			return;
		}

		$data["cliente"] = $clientes->row();
		$data["monedero"] = $monedero->result();

		$this->load->view('base/header',$data);
		$this->load->view('base/menu',$data);
		$this->load->view('clientes/monedero',$data);
		$this->load->view('base/footer');

	}

	function ajax_crear_direccion() {

		$id =    intval( $this->input->post("id") );
		$cp =    strip_tags( $this->input->post("cp") );
		$piso =    strip_tags( $this->input->post("piso") );
		$latitud =    strip_tags( $this->input->post("latitud") );
		$longitud =    strip_tags( $this->input->post("longitud") );
		$direccion_google = strip_tags( $this->input->post("direccion_go") );
		$numero = strip_tags( $this->input->post("numero") );
		$contacto_persona = strip_tags( $this->input->post("contacto_persona") );
		$contacto_telefono = strip_tags( $this->input->post("contacto_telefono") );

		$cliente = $this->db->get_where("clientes",array(
			"id"=>$id
		));

		if($cliente->num_rows() == 0){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en la actualización"));
			return false;
		}

		if(strlen($cp) == 0 or $cp == "" or !preg_match('/^(?:0?[1-9]|[1-4]\d|5[0-2])\d{3}$/', $cp)){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en el código postal"));
			return false;
		}
		if(strlen($piso) == 0 or $piso == ""){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en el piso"));
			return false;
		}
		if(strlen($latitud) == 0 or $latitud == ""){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en la dirección"));
			return false;
		}
		if(strlen($longitud) == 0 or $longitud == ""){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en la dirección"));
			return false;
		}
		if(strlen($direccion_google) == 0 or $direccion_google == ""){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en la dirección"));
			return false;
		}
		if(strlen($numero) == 0 or $numero == ""){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en el número"));
			return false;
		}

		$opciones = $this->db->get_where('opciones', array('opcion' => 'limitacion_cp'))->row();
		if($opciones->valor == 0){
			if(strlen($cp) == 0 or $cp == ""){
				echo json_encode(array("result"=>"error","mensaje"=>"Error en el cp"));
				return false;
			}
		}
		else{
			if(!$this->__comprobar_cp($cp)){
				echo json_encode(array("result"=>"error","mensaje"=>"No tenemos servicio en el codigo postal indicado ¡Estamos trabajando para ampliar el reparto!"));
				return false;
			}
		}

		$this->db->insert("clientes_direccion",array(
			"id_usuario" => $id,
			"direccion"=>$direccion_google,
			"latitud"=>$latitud,
			"longitud"=>$longitud,
			"direccion_google"=>$direccion_google,
			"numero"=>$numero,
			"codigo_postal"=>$cp,
			"piso" => $piso,
			"contacto_persona" => $contacto_persona,
			"contacto_telefono" => $contacto_telefono

		));

		if($this->db->affected_rows() > 0){

			echo json_encode(array("result"=>"success","mensaje"=>"Modificado correctamente"));
			return false;

		}else{

			echo json_encode(array("result"=>"error","mensaje"=>"Error, editar la dirección a fallado"));
			return false;

		}



	}

	function ajax_cambiar_direccion() {

		$id =    intval( $this->input->post("id") );

		$pedido = $this->db->get_where("pedidos",array(
			"id"=>$id
		));

		if($pedido->num_rows() == 0){
			echo json_encode(array("result"=>"error","mensaje"=>"Error en la actualización"));
			return false;
		}

		$cliente_direccion = $this->db->get_where("clientes_direccion",array("id"=>$id),1)->row();


		$opciones = $this->db->get_where('opciones', array('opcion' => 'limitacion_cp'))->row();

		if($pedido->id > 0){
			$this->db->where("id", $pedido->id)->update("pedidos",array(
				"direccion"=>$cliente_direccion->direccion,
				"latitud"=>$cliente_direccion->latitud,
				"longitud"=>$cliente_direccion->longitud,
				"direccion_google"=>$cliente_direccion->direccion_google,
				"numero"=>$cliente_direccion->numero,
				"codigo_postal"=>$cliente_direccion->codigo_postal,
				"piso" => $cliente_direccion->piso,
				"contacto_persona" => $cliente_direccion->contacto_persona,
				"contacto_telefono" => $cliente_direccion->contacto_telefono

			));
		}

		if($this->db->affected_rows() > 0){

			echo json_encode(array("result"=>"success","mensaje"=>"Modificado correctamente"));
			return false;

		}else{

			echo json_encode(array("result"=>"error","mensaje"=>"Error, editar la dirección a fallado"));
			return false;

		}



	}

	public function ajax_eliminar_direccion(){
		$id = intval ($this->input->post("id"));

		$direccion_r = $this->db->get_where("clientes_direccion",array(
			"id"=>$id
		));

		if($direccion_r->num_rows() == 0){
			echo json_encode(array("result"=>"error","mensaje"=>"Error al eliminar la dirección"));
			return false;
		}

		$direccion = $direccion_r->row(); //Obtengo el resultado del pedido

		if($direccion->id){
			$this->db->where("id",$direccion->id)->delete("clientes_direccion");
		}

		if($this->db->affected_rows() > 0){

			echo json_encode(array("result"=>"success","mensaje"=>"Modificado correctamente"));
			return false;

		}else{

			echo json_encode(array("result"=>"error","mensaje"=>"Error al eliminar la dirección"));
			return false;

		}


	}

	public function ajax_editar_detalles(){

		$id = intval ($this->input->post("id"));

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));


		if($clientes->num_rows() == 0){
			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"No se encuentra el usuario"));
			return;
		}


		$nombre = strip_tags($this->input->post("nombre"));
		$telefono = strip_tags($this->input->post("telefono"));
		$facturacion_nombre = strip_tags($this->input->post("facturacion_nombre"));
		$facturacion_nif = strip_tags($this->input->post("facturacion_nif"));
		$facturacion_direccion = strip_tags($this->input->post("facturacion_direccion"));


		if(strlen($nombre) == 0 or $nombre == ""){
			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"El nombre no es correcto"));
			return false;
		}
		if(strlen($telefono) == 0 or $telefono == "" or !preg_match('/^[6798]{1}[0-9]{8}$/', $telefono)){
			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"El teléfono no es correcto"));
			return false;
		}

		$estado_cliente = $this->input->post("estado_cliente");

		if(filter_var($estado_cliente, FILTER_VALIDATE_BOOLEAN) == true){
			$estado = 1;
		}else{
			$estado = 0;
		}


		$this->db->where("id",$id)->update("clientes",array(
			"nombre"=>$nombre,
			"telefono"=>$telefono,
			"facturacion_nombre" => $facturacion_nombre,
			"facturacion_nif" => $facturacion_nif,
			"facturacion_direccion" => $facturacion_direccion,
			"activo" => $estado
		));

		if($this->db->affected_rows() > 0){
			echo json_encode(array("result"=>"success","mensaje"=>"Modificado correctamente"));
			return false;
		}else{

			echo json_encode(array("result"=>"error","mensaje"=>"Error, los datos son los mismos."));
			return false;
		}


	}

	public function ajax_modificar_saldo(){

		$id = intval($this->input->post("id"));
		$saldo = $this->input->post("saldo");

		$saldo = str_replace(",",".", $saldo);

		$clientes = $this->db->get_where("clientes",array(
			"id"=>$id
		));


		if($clientes->num_rows() == 0){
			echo json_encode(array(
				"result"=>"error",
				"mensaje"=>"Error al modificar el saldo"
			));
			return;
		}

		if($saldo > 200){
			echo json_encode(array(
				"result"=>"error",
				"mensaje"=>"El saldo mayor a 200 euros está deshabilitado por seguridad. Para cubrir el saldo necesario añadir varios movimientos"
			));
			return;
		}

		$saldo_actual = $clientes->row()->saldo;

		if($saldo_actual == $saldo){
			echo json_encode(array(
				"result"=>"error",
				"mensaje"=>"El saldo es idéntico que el actual"
			));
			return;
		}

		if($saldo_actual > $saldo){

			$tipo_movimiento = "gasto_admin";
			$saldo_momento = $saldo;
			$movimiento = $saldo_actual - $saldo;

		}else{

			$tipo_movimiento = "anadido_admin";
			$saldo_momento = $saldo;
			$movimiento = $saldo - $saldo_actual;

		}


		$this->db->where("id",$id)->update("clientes",array(
			"saldo" => $saldo
		));



		$this->db->insert("clientes_saldo_movimiento",array(
			"tipo_movimiento" => $tipo_movimiento,
			"id_usuario" => $id,
			"valor" => abs($movimiento),
			"saldo_momento" => $saldo_momento,
			"validado" =>1
		));

		echo json_encode(array(
			"result"=>"success",
			"mensaje"=>"El saldo se modifico correctamente",
			"datos" => array(
				"tipo_movimiento"=>$tipo_movimiento,
				"saldo_momento"=>$saldo_momento,
				"valor_movimiento"=>$movimiento
			)
		));
		return;


	}

	private function __clientes($total = true)
	{
		$this->db->select("*");
		$this->db->from("clientes");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));

			$this->db->or_like("id",$b);
			$this->db->or_like("nombre",$b);
			$this->db->or_like("telefono",$b);
			$this->db->or_like("email",$b);

			$this->db->group_end();

		}


		if($this->input->get("filtrar_fecha") == "on") {
			if ($this->input->get("fecha_inicio") and $this->input->get("fecha_final")) {
				$this->db->group_start();

				$this->db->where('fecha_alta >=', $this->input->get("fecha_inicio") . " 00:00:00");
				$this->db->where('fecha_alta <=', $this->input->get("fecha_final")  . " 23:59:59");

				$this->db->group_end();

			}
		}

		if(!$this->input->get("activo")){
			$this->db->where("activo",1);
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

	private function __cantidad_pedidos($id,$fecha_inicio = "", $fecha_fin = ""){

		$this->db->select("count(*) as total_pedidos, sum(total_pedido) as total_facturacion");
		$this->db->from("pedidos");

		$this->db->where("activo", 1);
		$this->db->where("pagado",1);
		$this->db->where("id_usuario",$id);


		if($fecha_inicio != "" and $fecha_fin != ""){
			$this->db->where('fecha_entrega >=', $fecha_inicio . " 00:00:00");
			$this->db->where('fecha_entrega <=', $fecha_fin . " 23:59:00");
		}


		$r = $this->db->get();
		return $r->row();

	}

	private function __pedidos($id,$total = true)
	{
		$this->db->select("*");
		$this->db->from("pedidos");


		if ($this->input->get('b') != '') {

			$this->db->group_start();

			$b = trim($this->input->get('b'));
			$this->db->or_like("id",$b);
			$this->db->or_like("nombre",$b);
			$this->db->or_like("email",$b);
			$this->db->or_like("telefono",$b);
			$this->db->or_like("direccion",$b);
			$this->db->or_like("cp",$b);

			$this->db->group_end();

		}

		$this->db->where("id_usuario",$id);

		if($this->input->get("filtrar_fecha") == "on") {
			if ($this->input->get("fecha_inicio") and $this->input->get("fecha_final")) {
				$this->db->group_start();

				$this->db->where('fecha_entrega >=', $this->input->get("fecha_inicio"));
				$this->db->where('fecha_entrega <=', $this->input->get("fecha_final"));

				$this->db->group_end();
			}
		}


		if(!$this->input->get("no_pagado")){
			$this->db->where("pagado",1);
		}

		if($this->input->get("solo_activos")){
			$this->db->where("activo",1);
		}


		$this->db->where("activo", 1);



		if ($total) {
			return $this->db->count_all_results();
		} else {

			$this->db->order_by("id DESC");

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




}
	?>
