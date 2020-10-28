<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
	var $key = "D8atH3chERqCGCJ9lyaqrS5yzJQRiZL4qwOHXT5oSToVA";
	var $payload = "";


	function __construct(){

		$token_server = $_SERVER['HTTP_AUTHORIZATION'];

		if($token_server != $this->key){
				$this->__respuesta("El token no es correcto",401 );
		}

		$this->payload = $this->__test_empty(
								json_decode( file_get_contents('php://input'), true));

	}

	public function recibir_shargo(){


		foreach($this->payload as $py){

			$ruta = 		$this->__limpiar_consulta($this->security->xss_clean($py->ruta));
			$repartidor = 	$this->__limpiar_consulta($this->security->xss_clean($py->repartidor));
			$telefon = 		$this->__limpiar_consulta($this->security->xss_clean($py->telefon));

			$this->__campos_shargo($py);


			foreach($py->comandes as $c){

				$comanda   = 		$this->__limpiar_consulta($this->security->xss_clean($c->comanda));
				$ordre     = 		$this->__limpiar_consulta($this->security->xss_clean($c->ordre));
				$id_shargo = 	$this->__limpiar_consulta($this->security->xss_clean($c->id_shargo));

				$this->__test_campo($this->id_shargo, "id shargo");

				$existe_shargo = $this->db->get_where("pedidos",array(
					"id_shargo"=> $id_shargo
				))->num_rows();

				if(!$existe_shargo){
					$this->__respuesta("El id de shargo " .  $id_shargo . " No existe",411);
				}

				$this->db->where("id_shargo",$id_shargo)->update(

					array(
						"repartidor_ruta"=>$ruta,
						"repartidor_nombre"=>$repartidor,
						"repartidor_telefon"=>$telefon,
						"repartidor_orden"=> $ordre
					));

			}


		}

	}

	private function __campos_shargo($py){

		$campos = array("ruta","repartidor","comandes","telefon");

		foreach($campos as $campo){

			if( !isset($py->$campo) ){
				$this->__respuesta($campo . " No definido", 409 );
			}

		}

	}


	private function __test_empty($json_decode){

		if( empty ($json_decode) ){

			$this->__respuesta("No existe información post",405);

		}

	}

	private function __test_campo($variable,$mensaje){

		if( empty ($variable) ){

			$this->__respuesta("No existe información en " . $mensaje,410);

		}

	}

	private function __respuesta($mensaje,$codigo){


		echo json_encode(array(
			"token_server" =>$codigo,
			"mensaje"=>$mensaje,
			"fecha"=>date("Y-m-d H:i:s")
		));

		exit();

	}

	function __limpiar_consulta($str)
	{
		$str = strip_tags(addslashes(stripslashes(htmlspecialchars($str))));
		return $str;
	}




}
