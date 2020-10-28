<?php

Class Shargo{


	/**
	 *  Url api de Shargo
	 */

	var $url = "https://api.shargo.io/v1/deliveries";

	/**
	 *  Token api de Shargo
	 */
	var $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiI1OTE5Y2UxNGI1NWFlMGNmNmQxOWZhNjEiLCJpYXQiOjE1ODU1ODY1OTAsImV4cCI6MTEwNDYzODY1OTB9.JB6aLuyTfShZ25wWeVVtwv_8MkuDovTZItwXPm6yEa4";



	/**
	 *  Origen
	 */

	var $o_direccion = "";
	var $o_latitud = "";
	var $o_longitud = "";
	var $o_comentarios = "";

	/**
	 *  Destino
	 */

	var $d_direccion = "";
	var $d_latitud = "";
	var $d_longitud = "";
	var $d_comentarios = "";

	var $d_nombre = "";
	var $d_telefono = "";


	/**
	 *  Items y transporte
	 */

	var $d_items = 1;
	var $d_transport = 1;

	/**
	 *  Fecha
	 */

	var $d_fecha = "";




	public function set_parametros_solicitar($parametros = []){


		/**
		 *
		 * Dirección Origen
		 *
		 */

		if(!isset($parametros["o_direccion"])) {
			echo json_encode(
				array(
					"code"=>001,
					"message"=>"Falta definir el parametro de origen dirección"
				)
			);
			return false;
		}
		$this->o_direccion = $parametros["o_direccion"];



		/**
		 *
		 * Latitud Origen
		 *
		 */

		if(!isset($parametros["o_latitud"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de origen latitud"
				)
			);
			return false;
		}
		$this->o_latitud = $parametros["o_latitud"];



		/**
		 *
		 * Longitud Origen
		 *
		 */

		if(!isset($parametros["o_longitud"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de origen longitud"
				)
			);
			return false;
		}
		$this->o_longitud = $parametros["o_longitud"];



		/**
		 *
		 * Comentarios Origen
		 *
		 */

		if(isset($parametros["o_comentarios"])) {
			$this->o_comentarios = $parametros["o_comentarios"];
		}


		/**
		 *
		 * Dirección Destino
		 *
		 */

		if(!isset($parametros["d_direccion"])) {
			echo json_encode(
				array(
					"code"=>001,
					"message"=>"Falta definir el parametro de Destino dirección"
				)
			);
			return false;
		}
		$this->d_direccion = $parametros["d_direccion"];



		/**
		 *
		 * Latitud Destino
		 *
		 */

		if(!isset($parametros["d_latitud"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de Destino latitud"
				)
			);
			return false;
		}
		$this->d_latitud = $parametros["d_latitud"];



		/**
		 *
		 * Longitud Destino
		 *
		 */

		if(!isset($parametros["d_longitud"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de Destino longitud"
				)
			);
			return false;
		}
		$this->d_longitud = $parametros["d_longitud"];



		/**
		 *
		 * Comentarios Destino
		 *
		 */

		if(isset($parametros["d_comentarios"])) {
			$this->d_comentarios = $parametros["d_comentarios"];
		}



		/**
		 *
		 * Nombre Destino
		 *
		 */

		if(!isset($parametros["d_nombre"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de Destino Nombre"
				)
			);
			return false;
		}
		$this->d_nombre = $parametros["d_nombre"];



		/**
		 *
		 * Telefono Destino
		 *
		 */

		if(!isset($parametros["d_telefono"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de Destino Teléfono"
				)
			);
			return false;
		}
		$this->d_telefono = $parametros["d_telefono"];



		/**
		 *
		 * Fecha Destino
		 *
		 */

		if(!isset($parametros["d_fecha"])) {
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de Destino Fecha"
				)
			);
			return false;
		}

		$this->d_fecha = $parametros["d_fecha"];


		/**
		 *
		 * Items Destino
		 *
		 */

		if(!isset($parametros["d_items"])) {
			$this->d_items = $parametros["d_items"];
		}


		/**
		 *
		 * Transport Destino
		 *
		 */

		if(!isset($parametros["d_transport"])) {
			$this->d_transport = $parametros["d_transport"];
		}

		return true;




	}

	public function solicitar($parametros = []){

		if( !$this->validar_acceso() ){ //Valido que tengo token y url
			return false;
		}
		if( !$this->set_parametros_solicitar($parametros) ){ //Completo los parametros
			return false;
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(

			CURLOPT_URL => $this->url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($this->set_parametros_solicitar_array()),
			CURLOPT_HTTPHEADER => array(
				"Accept: */*",
				"Authorization:" . $this->token,
				"Content-Type: application/json",
			)

		));

		$response = curl_exec($curl);
		$err = curl_error($curl);


		curl_close($curl);

		if ($err) {

			return false;
			//Marcar un error en el pedido de comunicación con shargo

		} else {
			return json_decode($response);
		}


	}

	private function set_parametros_solicitar_array(){


		return $json = array(

			"transport" => (float) $this->d_transport,

			"originAddress"=> $this->o_direccion,
			"originLatitude" =>  (float) $this->o_latitud,
			"originLongitude" => (float) $this->o_longitud,
			"originComment" => $this->o_comentarios,

			"destinationAddress" => $this->d_direccion,
			"destinationLatitude" => (float) $this->d_latitud,
			"destinationLongitude" =>(float) $this->d_longitud,
			"destinationComment" => $this->d_comentarios,

			"contactName" => $this->d_nombre,
			"contactPhone" => $this->d_telefono,


			"numItems" => (float) $this->d_items,
			"orderDate" => (float) strtotime($this->d_fecha ." 10:00")


		);

	}

	private function validar_acceso(){


		if(empty( $this->url ) ){
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de url"
				)
			);
			return false;
		}

		if(empty( $this->token ) ){
			echo json_encode(
				array(
					"code"=>002,
					"message"=>"Falta definir el parametro de token"
				)
			);
			return false;
		}

		return true;


	}


}
