<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller
{


	public function calculo_iva(){

		$pr = $this->db->get("productos");
		if($pr->num_rows() > 0){

			foreach($pr->result() as $p){

				$precio_final = 0;

				if(empty($p->precio) and !empty($p->precio_sin_iva)){

					$impuesto = floatval(1 . "." . $p->impuesto);
					$precio_final = $p->precio_sin_iva * $impuesto;
					echo $precio_final;

					$this->db->where("id",$p->id)->update("productos",array(
						"precio" =>  number_format($precio_final,2,".","")
					));

				}

				if(!empty($p->precio) and empty($p->precio_sin_iva)){

					$impuesto = floatval(1 . "." . $p->impuesto);
					$precio_final = $p->precio / $impuesto;

					$this->db->where("id",$p->id)->update("productos",array(
						"precio_sin_iva" => number_format($precio_final,2,".","")
					));

				}

				if(empty($p->precio_oferta) and !empty($p->precio_oferta_sin_iva)){

					$impuesto = floatval(1 . "." . $p->impuesto);
					$precio_final = $p->precio_oferta_sin_iva * $impuesto;

					$this->db->where("id",$p->id)->update("productos",array(
						"precio_oferta" =>  number_format($precio_final,2,".","")
					));

				}

				if(!empty($p->precio_oferta) and empty($p->precio_oferta_sin_iva)){

					$impuesto = floatval(1 . "." . $p->impuesto);
					$precio_final = $p->precio_oferta/ $impuesto;

					$this->db->where("id",$p->id)->update("productos",array(
						"precio_oferta_sin_iva" => number_format($precio_final,2,".","")
					));

				}

			}

		}

	}

	public function desglose_iva(){

		$pr = $this->db->get("productos");
		if($pr->num_rows() > 0) {

			foreach ($pr->result() as $p) {
					if( !empty($p->precio_sin_iva) and !empty($p->precio) ){


							$desglose  =  ($p->precio - $p->precio_sin_iva);
							$desglose = number_format($desglose,2,".","");

							if($desglose > 0){
								$this->db->where("id",$p->id)->update("productos",array(
										"desglose"=>$desglose
								));
							}

					}
				if( !empty($p->precio_oferta_sin_iva) and !empty($p->precio_oferta) ){


					$desglose  =  ($p->precio_oferta - $p->precio_oferta_sin_iva);
					$desglose = number_format($desglose,2,".","");

					if($desglose > 0){
						$this->db->where("id",$p->id)->update("productos",array(
							"desglose_oferta"=>$desglose
						));
					}

				}

			}

		}

	}

	public function fecha_creacion(){

		$pr = $this->db->get("productos");
		if($pr->num_rows() > 0) {

			foreach ($pr->result() as $p) {

				if(empty($p->fecha_creacion)){
					$this->db->where("id",$p->id)->update("productos",array(
						"fecha_creacion" => date("Y-m-d H:i:s")
					));
				}
			}
		}
	}

	public function generar_slugs(){

		$slug_v_r = $this->db->get_where(
			"productos",array(
				"slug" => NULL
			)
		);

		if($slug_v_r->num_rows() > 0){

			foreach($slug_v_r->result() as $svr){

				if(intval( $svr->id ) > 0){

					$slug = $this->__slug($svr->nombre);

					if(empty($slug)){
						$slug = "producto_" . rand(00000,99999);
					}


					$i = 1;
					$slug_base = $slug;

					while($this->__test_slug($slug_base)){
						$slug_base = $slug. "-" . $i++;
					}


					 if( !empty($slug_base) ){
						 $this->db->where("id",$svr->id)->update("productos",array(
							 "slug" => $slug_base
						 ));
					 }

				}

			}

		}

	}

	private function __test_slug($slug){

		$r = $this->db->get_where("productos",array(
			"slug"=>$slug
		))->num_rows();

		if($r > 0){
			return true;
		}else{
			return false;
		}

	}

	private static function __slug($text)
	{
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);

		if (empty($text)) {
			return 'producto-sin-nombre';
		}
		return $text;
	}

}
