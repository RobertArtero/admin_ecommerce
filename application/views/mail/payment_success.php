<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Pedido confirmado - Gumen Càtering</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style type="text/css">
                .web {
                    color: #009;
                }
                a:link {
                    color: #009;
                }
                a:visited {
                    color: #009;
                }
                a:hover {
                    color: #009;
                }
                a:active {
                    color: #009;
                }
            </style>
    </head>
    <body style="background-color:#F5F5F5">
        <table border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; font-weight:100; font-family:Arial, Helvetica, sans-serif; position:relative; text-align:center;">
            <tr>
                <td colspan="1" style="background-color:#444443; color:white; text-align:left; height:90px;">
                    <a href="http://www.gumen-catering.com"><img style="float:left;margin:20px 0 0 50px;" src="http://gumen-catering.com/wp-content/uploads/2017/06/logo-gumen-catering_white.png"/></a>
                    <a href="http://www.gumen-catering.com"><img style="float:right;" src="http://gumen-catering.com/wp-content/uploads/2017/06/pattern_food.png" /></a></td>
            </tr>
            <tr>
                <td width="655" height="75" style="width:655px; height:75px; background-color:#FFF; valign:top;">
                    <p style="margin:15px 50px 30px 50px; color:#000; font-size:13px; text-decoration:none; padding:10px 0px 0px 0px; line-height:22px;">Apreciado <strong><?php echo $cliente->name . ' ' . $cliente->surname; ?></strong>,<br><br>
                                Primero de todo gracias por confiar en nosotros. Te envíamos el resumen de tu pedido:</p>
                                </td>
                                </tr>
                                <tr>
                                    <th width="655" height="2" style="width:655px; height:2px; background-color:#fff; valign:top;">
                                        <table>
                                            <tr>
                                                <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                                <td width="300" height="20" style="width:300px; height:20px; background-color:#FFF; valign:top;">
                                                    <p style="margin:-5px 0px 0px 0px; color:#000; font-size:13px; text-decoration:none; line-height:22px;"><strong>Descripción</strong></p>
                                                </td>
                                                <td width="155" height="20" style="width:155px; height:20px; background-color:#FFF; valign:top;">
                                                    <p style="margin:-5px 0px 0px 0px; color:#000; font-size:13px; text-decoration:none; line-height:22px; margin:0px 5px 0 60px; text-align:center;"><strong>Cantidad</strong></p>
                                                </td>
                                                <td width="200" height="20" style="width:200px; height:20px; background-color:#FFF; valign:top;">
                                                    <p style="margin:-10px 0px -5px 0px; color:#4E4E4E; font-size:13px; text-decoration:none; line-height:22px; margin:3px 8px 0 0; text-align:right;"><strong>Precio</strong></p>
                                                </td>
                                                <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="655" height="2" style="width:655px; height:2px; background-color:#FFF; valign:top;">
                                        <hr color="#bf9f72" width="47px" size="2px" style="float:left;">
                                            <hr color="#444443" width="555px" size="2px" style="float:left;">
                                                <hr color="#bf9f72" width="47px" size="2px" style="float:right;">
                                                    </th>
                                                    </tr>
                                                    <?php
                                                    $total_price = 0.00;
                                                    $bool = false;
                                                    if ($pedidos) {
                                                        $bool = true;
                                                        /* echo '<pre>';
                                                          print_r($orders); exit; */
                                                        foreach ($pedidos as $pedido) {
                                                            ?>

                                                            <tr>
                                                                <th width="655" height="20" style="width:655px; height:20px; background-color:#FFF; valign:top;">
                                                                    <table>
                                                                        <tr>
                                                                            <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                                                            <td width="300" height="20" style="width:300px; height:20px; background-color:#FFF; valign:top;">
                                                                                <p style="margin:-5px 0px 0px 0px; color:#000; font-size:13px; text-decoration:none; line-height:22px;"><?php echo $pedido->id_pedido . ' - ' . $pedido->codigo_menu ." - ".date("d/m/Y",strtotime($pedido->fecha_entrega)) ?></p>
                                                                                <p style="margin:-10px 0px -5px 0px; color:#4E4E4E; font-size:13px; text-decoration:none; line-height:22px;"><?php

                                                                                    $platos = json_decode($pedido->json_platos);

                                                                                    foreach ( $platos as $plato ) {

                                                                                        if ( substr($plato,0,3) == 'sup' ) {

                                                                                            $id_plato = explode('-',$plato);

                                                                                            echo $this->Delivery_model->getPlatoSuplemento($id_plato[1]);
                                                                                            echo '<br>';

                                                                                        } else {

                                                                                            $id_plato = $plato;

                                                                                            echo $this->Delivery_model->getPlato($id_plato);
                                                                                            echo '<br>';

                                                                                        }

                                                                                    }

                                                                                    $extras = json_decode($pedido->json_extras);

                                                                                    foreach ( $extras as $extra ) {

                                                                                        echo $extra[1] . ' x' . $extra[3];

                                                                                    }

                                                                                    $total_price += doubleval($pedido->precio_total);


                                                                                    ?></p>
                                                                            </td>
                                                                            <td width="155" height="20" style="width:155px; height:20px; background-color:#FFF; valign:top;">
                                                                                <p style="margin:-5px 0px 0px 0px; color:#000; font-size:13px; text-decoration:none; line-height:22px; margin:3px 5px 0 60px; text-align:center;">1</p>
                                                                            </td>
                                                                            <td width="200" height="20" style="width:200px; height:20px; background-color:#FFF; valign:top;">
                                                                                <p style="margin:-10px 0px -5px 0px; color:#4E4E4E; font-size:13px; text-decoration:none; line-height:22px; margin:3px 5px 0 0; text-align:right;"><?php echo number_format($pedido->precio_total,2); ?> &euro;</p>
                                                                            </td>
                                                                            <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                                                        </tr>
                                                                    </table>
                                                                </th>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>


                                                    <tr>
                                                        <th width="655" height="2" style="width:655px; height:2px; background-color:#FFF; valign:top;">
                                                            <hr color="#bf9f72" width="47px" size="2px" style="float:left;">
                                                                <hr color="#444443" width="555px" size="2px" style="float:left;">
                                                                    <hr color="#bf9f72" width="47px" size="2px" style="float:right;">
                                                                        </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th width="655" height="20" style="width:655px; height:20px; background-color:#FFF; valign:top;">
                                                                                <table>
                                                                                    <tr>
                                                                                        <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                                                                        <td width="300" height="20" style="width:300px; height:20px; background-color:#FFF; valign:top;">
                                                                                            <p style="margin:-5px 0px 0px 0px; color:#000; font-size:13px; text-decoration:none; line-height:22px;"></p>
                                                                                        </td>
                                                                                        <td width="155" height="20" style="width:155px; height:20px; background-color:#FFF; valign:top;">
                                                                                        </td>
                                                                                        <td width="200" height="20" style="width:200px; height:20px; background-color:#FFF; valign:top;">
                                                                                            <p style="margin:-10px 0px -5px 0px; color:#4E4E4E; font-size:13px; text-decoration:none; line-height:22px; text-align:right; margin:3px 5px 30px 0;">

                                                                                                    <strong>Total : <span style="color:#c49e56"><?php echo number_format($total_price, 2); ?> &euro;</span><br/>
                                                                                                        <?php echo 'Método de pago:'; ?> <span style="color:#c49e56;"><?php echo isset($forma_pago) ? $forma_pago : 'Forma de pago'; ?></span></strong><br>
                                                                                                        <?php echo 'Centro:'; ?> <span style="color:#c49e56;"><?php echo isset($centro) ? $centro : 'Centro por defecto'; ?></span></strong><br>

                                                                                            </p>
                                                                                        </td>
                                                                                        <td width="47" height="20" style="width:47px; height:20px; background-color:#FFF; valign:top;"></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="655" height="130" style="width:655px; height:130px; background-color:#FFF" valign="top">
                                                                                <table width="655" border="0" cellspacing="0" cellpadding="0" style="width:655px;">
                                                                                    <tr>
                                                                                        <td width="655" height="100" style="width:655px; height:100px;">
                                                                                            <p style="margin:-20px 50px 0px 50px; color:#000; font-size:13px; text-decoration:none; padding:10px 0px 0px 0px; line-height:22px; text-align:center;">Si tienes cualquier duda, puedes ponerte en contacto con nosotros a través de este mail:<br><a href="mailto:pedidos@gumen-catering.com" style="text-decoration:none; font-size:15px; color:#bf9f72;"><br>
                                                                                                            pedidos@gumen-catering.com</a><br><br>
                                                                                                            ¡Que aproveche! / <strong>Bon Profit!</strong> / <i>Have a good meal!</i></p>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            </table>
                                                                                                            </td>
                                                                                                            </tr>           
                                                                                                            </table>
                                                                                                            <!--FOOTER-->
                                                                                                            <table style="display:block; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #444443; margin:0 auto;" cellpadding="0" cellspacing="0" border="0" width="655">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <th width="288" colspan="1" style="background-color:#444443; font-size:12px; color:white; text-align:left; margin:30px; font-family: Arial, Helvetica, sans-serif; line-height:18px;font-weight:100; height:90px;">
                                                                                                                            <span style="margin-left:50px;"><i>C/</i> Tamarit 10  |  08205 Sabadell<br>
                                                                                                                                    <span style="margin-left:50px;"><i>Telf.</i> 93 717 83 35</span><br>
                                                                                                                                        <a style="font-weight:bold; color: #bf9b55; margin-left:50px; "href=	"http://www.gumen-catering.com">www.gumen-catering.com</a></span></th>
                                                                                                                                        <th width="367" rowspan="1" style="background-color:#444443;"><a href="http://www.gumen-catering.com"><img style="float:right;" src="http://gumen-catering.com/wp-content/uploads/2017/06/pattern_food.png" /></a></th>
                                                                                                                                        </tr>
                                                                                                                                        <tr>
                                                                                                                                            <td colspan="2" height="10px"></td>
                                                                                                                                        </tr>
                                                                                                                                        <tr style="font-size:9px;">
                                                                                                                                            <td colspan="2" align="justify">No se admitirán incidencias transcurridas 24h de la fecha del pedido. Este pedido se puede anular hasta el mismo día a las 09.00am en su apartado de MIS PEDIDOS.<br><br></td>
                                                                                                                                        </tr>
                                                                                                                                        <tr style="font-size:9px;">
                                                                                                                                            <td colspan="2" align="justify">El contenido de este correo electrónico es confidencial y va dirigido únicamente a la persona destinataria. Si usted no es su destinatario, no está autorizado para su uso, por lo que le rogamos informe del error al remitente y proceda a su inmediata eliminación.</td>
                                                                                                                                        </tr>

                                                                                                                                        <tr style="font-size:9px;">
                                                                                                                                            <td colspan="2" align="justify">El contingut d’aquest correu electrònic és confidencial i està adreçat únicament a la persona destinatària. Si vostè no n’és el destinatari, no està autoritzat a utilitzar-lo. En aquest cas, preguem que informi de l’error al remitent i procedeixi a eliminar-lo immediatament.</td>
                                                                                                                                        </tr>
                                                                                                                                        <tr style="font-size:9px;">
                                                                                                                                            <td colspan="2" align="justify">This e-mail contains confidential information and is intended solely for the person to whom it is addressed. If you are not the intended recipient, you are not authorized to use it. In such case, please inform the sender of the mistake and proceed to delete this e-mail immediately.</td>
                                                                                                                                        </tr>
                                                                                                                                        </tbody>
                                                                                                                                        </table>
                                                                                                                                        </body>
                                                                                                                                        </html>
