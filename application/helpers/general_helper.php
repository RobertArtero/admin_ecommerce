<?php

	function __method() {
		$ci = & get_instance();
		return $ci->router->fetch_method();
	}

	function __class() {
		$ci = & get_instance();
		return $ci->router->fetch_class();
	}

	function __dinero($d, $moneda = true){
		if($moneda == false){
			$moneda = "";
		}else{
			$moneda = "€";
		}

		return number_format($d , 2 , ","  , ".") . $moneda;
	}

	function __fecha($fecha = "", $formato = "Y-m-d" , $horas = false){

		if(!$fecha){
			$fecha = date("Y-m-d");
		}
		$fecha_r = DateTime::createFromFormat($formato, $fecha);

		if($horas){
			return $fecha_r->format('d/m/Y H:i:s');
		}else{
			return $fecha_r->format('d/m/Y');
		}

	}
	function __metodos_pago($id){

		$ci = & get_instance();
		$c = $ci->db->get_where("metodos_pago",array(
			"id"=>$id
		));
		return $c->row();

	}
	function __cliente($id){

		$ci = & get_instance();
		$c = $ci->db->get_where("clientes",array(
			"id"=>$id
		));
		return $c->row();

	}
	function __cupon($id){

		$ci = & get_instance();
		$c = $ci->db->get_where("cupones",array(
			"id"=>$id
		));
		return $c->row();

	}

	function __seguimiento($id){

		$ci = & get_instance();
		$c = $ci->db->get_where("mkt_seguimiento",array(
			"id"=>$id
		));
		return $c->row();

	}

	function __pedidos($id_cliente){

		$ci = & get_instance();

		$c = $ci->db->get_where("pedidos",array(
			"id_usuario"=>$id_cliente,
			"pagado" => 1
		));

		return $c->num_rows();

	}

	function __acortar($string, $length=14){

		$stringDisplay = substr(strip_tags($string), 0, $length);

		if (strlen(strip_tags($string)) > $length){
			$stringDisplay .= '...';
		}
		return $stringDisplay;

	}

	function __existe_fichero($url){
			$result=get_headers($url);
			return stripos($result[0],"200 OK")?true:false;
	}

	function __pm($v){
		return ucwords(strtolower($v));
	}

	function __arreglo_fecha_completa($date){


		$dia = date("d",strtotime($date));
		$mes = date("m",strtotime($date));
		$ano = date("Y",strtotime($date));

		return $dia ." ".  __arreglo_fecha($mes) . ", " . $ano;

	}

	function __arreglo_fecha($d){


		switch ($d) {
			case 1:
				return "Enero";
				break;
			case 2:
				return "Febrero";
				break;
			case 3:
				return "Marzo";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Mayo";
				break;
			case 6:
				return "Junio";
				break;
			case 7:
				return "Julio";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Septiembre";
				break;
			case 10:
				return "Octubre";
				break;
			case 11:
				return "Noviembre";
				break;
			case 11:
				return "Diciembre";
				break;
		}



}
