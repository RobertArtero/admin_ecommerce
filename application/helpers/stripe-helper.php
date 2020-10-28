<?php

function cobrar_stripe($precio,$pedido,$stripe_token){

	require_once(APPPATH.'libraries/stripe/stripe/Stripe.php');


	$errors = array(
		'incorrect_number'=> "El número de tarjeta es incorrecto.",
		'invalid_number'=> "El número de tarjeta no es un número de tarjeta válido.",
		'invalid_expiry_month'=> "El mes de caducidad de la tarjeta no es válido.",
		'invalid_expiry_year'=> "El año de caducidad de la tarjeta no es válido.",
		'invalid_cvc'=> "El código de seguridad de la tarjeta no es válido.",
		'expired_card'=> "La tarjeta ha caducado.",
		'incorrect_cvc'=> "El código de seguridad de la tarjeta es incorrecto.",
		'incorrect_zip'=> "Falló la validación del código postal de la tarjeta.",
		'card_declined'=> "La tarjeta fué rechazada.",
		'missing'=> "El cliente al que se está cobrando no tiene tarjeta",
		'processing_error'=> "Ocurrió un error procesando la tarjeta.",
		'rate_limit'=>  "Ocurrió un error debido a consultar la API demasiado rápido. Por favor, avísanos si recibes este error continuamente."
	);
	$params = array(
		"testmode"   => "on",
		"private_live_key" => "sk_live_xxxxxxxxxxxxxxxxxxxxx",
		"public_live_key"  => "pk_live_xxxxxxxxxxxxxxxxxxxxx",
		"private_test_key" => "sk_test_Z1YHRKNYBlDHk8UPXHgEBdQf",
		"public_test_key"  => "pk_test_eR3P4gDxge7FMCHkG2cqtjoX"
	);

	if ($params['testmode'] == "on") {
		Stripe::setApiKey($params['private_test_key']);
		$pubkey = $params['public_test_key'];
	}
	else {
		Stripe::setApiKey($params['private_live_key']);
		$pubkey = $params['public_live_key'];
	}

	if($stripe_token){

		$cargo_compra = $precio;
		$amount_cents = str_replace(".", "", number_format($cargo_compra,2,'.',''));  // Chargeble amount
		$invoiceid = $pedido->email;// Invoice ID
		$description = 'gift_pack_'.$pedido->name." #" . $invoiceid . " - " . $invoiceid;
		$customer = null;

		try {

			$customer = Stripe_Customer::create(
				array(
					"description" => $pedido->email,
					"source" => $stripe_token
				)
			);

			$charge = Stripe_Charge::create(
				array(
					"amount" => $amount_cents,
					"currency" => "eur",
					"customer" => $customer->id,
					"description" => $description
				)
			);

			if ($charge->card->address_zip_check == "fail") {
				throw new Exception("zip_check_invalid");
			}
			else if ($charge->card->address_line1_check == "fail") {
				throw new Exception("address_check_invalid");
			}
			else if ($charge->card->cvc_check == "fail") {
				throw new Exception("cvc_check_invalid");
			}
			else{

				$error = 0;
				$result = "success";

				if( intval($precio) == 0){

					try{

						$ch = Stripe_Charge::retrieve($charge->id);
						$ch->refunds->create(array('amount' => $amount_cents));


					} catch (Exception $e) {
						$result = $e->getMessage();
						$error = 1;
					}
				}

				return array('error' => $error , 'msg' =>  $result, 'pubkey' => $pubkey, 'customer' => $customer);
			}


		} catch (Stripe_CardError $e) {
			$error= $e->getMessage();
			$result = $error;
		} catch (Stripe_InvalidRequestError $e) {
			$error = $e->getMessage();
			$result = $error;
		} catch (Stripe_AuthenticationError $e) {
			$error = $e->getMessage();
			$result = $error;
		} catch (Stripe_ApiConnectionError $e) {
			$error = $e->getMessage();
			$result = $error;
		} catch (Stripe_Error $e) {
			$error = $e->getMessage();
			$result = $error;
		} catch (Exception $e) {
			$result = $e->getMessage();
		}

		if($result != "success"){
			if(isset($errors[$result])){
				$result = $errors[$result];
			}else{
				$result = 'La tarjeta no es válida o deniega el pago. Si el problema persiste contacta con nosotros';
			}
		}

		return array('error' => 1 , 'msg' =>  $result, 'pubkey' => $pubkey , 'customer' => $customer);

	}

	return array('error' => 0 , 'pubkey' => $pubkey);

}
