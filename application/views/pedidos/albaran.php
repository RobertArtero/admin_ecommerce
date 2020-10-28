<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Example 1</title>
	<style>
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 300;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Light'), local('Montserrat-Light'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-300italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 300;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Light Italic'), local('Montserrat-LightItalic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-300italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 400;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Italic'), local('Montserrat-Italic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-regular - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 400;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Regular'), local('Montserrat-Regular'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-regular.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-500 - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 500;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Medium'), local('Montserrat-Medium'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-600 - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 600;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.eot'); /* IE9 Compat Modes */
			src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-500italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 500;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Medium Italic'), local('Montserrat-MediumItalic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-500italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-700 - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 700;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Bold'), local('Montserrat-Bold'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-600italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 600;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat SemiBold Italic'), local('Montserrat-SemiBoldItalic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-600italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-700italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 700;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Bold Italic'), local('Montserrat-BoldItalic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-700italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-800italic - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: italic;
			font-weight: 800;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.eot'); /* IE9 Compat Modes */
			src: local('Montserrat ExtraBold Italic'), local('Montserrat-ExtraBoldItalic'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800italic.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-800 - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 800;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.eot'); /* IE9 Compat Modes */
			src: local('Montserrat ExtraBold'), local('Montserrat-ExtraBold'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-800.svg#Montserrat') format('svg'); /* Legacy iOS */
		}
		/* montserrat-900 - latin */
		@font-face {
			font-family: 'Montserrat';
			font-style: normal;
			font-weight: 900;
			src: url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.eot'); /* IE9 Compat Modes */
			src: local('Montserrat Black'), local('Montserrat-Black'),
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.woff2') format('woff2'), /* Super Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.woff') format('woff'), /* Modern Browsers */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.ttf') format('truetype'), /* Safari, Android, iOS */
			url('<?php echo base_url(); ?>/fonts/montserrat-v14-latin-900.svg#Montserrat') format('svg'); /* Legacy iOS */
		}

		.clearfix:after {
			content: "";
			display: table;
			clear: both;
		}

		a {
			color: #5D6975;
			text-decoration: underline;
		}

		body {
			font-family: 'Montserrat', helvetica !important;
			position: relative;
			width: 100%;
			height: 29.7cm;
			margin: 0 auto;
			color: #001028;
			background: #FFFFFF;
			font-size: 12px;
		}

		header {
			padding: 10px 0;
			margin-bottom: 30px;
		}

		#logo {
			text-align: center;
			margin-bottom: 10px;
		}

		#logo img {
			width: 150px;
		}

		h1 {
			color: black;
			font-size: 1.8em;
			font-weight: 300 !important;
			text-align: left;
			margin: 0 0 4px 0;
		}

		#col-derecha {
			float: left;
			display: inline-block;
			width: 50%
		}

		#col-derecha span {
			color: #5D6975;
			text-align: left;
			width: 52px;
			margin-right: 10px;
			display: inline-block;
			font-size: 0.8em;
		}

		#col-izquierda {
			float: right;
			display: inline-block;
			width: 50%

		}


		table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			margin-bottom: 20px;
		}

		table tr:nth-child(2n-1) td {
			background: #F5F5F5;
		}

		table th,
		table td {
			text-align: left;
		}

		table th {
			padding: 2px 10px;
			color: #5D6975;
			border-bottom: 1px solid #C1CED9;
			white-space: nowrap;
			font-weight: normal;
		}

		table .service,
		table .desc {
			text-align: left;
		}

		table td {
			padding: 10px;
			text-align: left;
		}

		table td.service,
		table td.desc {
			vertical-align: top;
		}

		table td.unit,
		table td.qty,
		table td.total {
			font-size: 1.2em;
		}

		table td.grand {
			border-top: 1px solid #5D6975;;
		}

		#notices .notice {
			color: #5D6975;
			font-size: 1.2em;
		}

		footer {
			color: #5D6975;
			width: 100%;
			height: 30px;
			position: absolute;
			bottom: 0;
			border-top: 1px solid #C1CED9;
			padding: 8px 0;
			text-align: center;
		}
	</style>
</head>
<body>
<header class="clearfix">

	<div id="logo">
		<img src="<?php echo FCPATH; ?>/assets/img/logo.png">
	</div>
	<div id="col-izquierda" class="clearfix">
		<h1>Nº<strong><?php echo $pedido->id; ?></strong></h1>
		<div><?php echo $this->nombre_fiscal_empresa; ?></div>
		<div><?php echo $this->direccion_empresa; ?></div>
		<div><?php echo $this->telefono_empresa; ?></div>
		<div><a href="mailto:<?php echo $this->email_empresa; ?>"><?php echo $this->email_empresa; ?></a></div>
	</div>
	<div id="col-derecha">
		<div><strong><?php echo $pedido->nombre ?></strong></div>
		<div><?php echo $pedido->direccion; ?> Piso: <?php echo $pedido->piso ?></div>
		<div><?php echo $pedido->telefono; ?></div>
		<div><?php echo $pedido->email; ?></div>
		<div><?php echo __fecha($pedido->fecha_entrega , "Y-m-d"); ?></div>
	</div>

</header>
<main>
	<table>
		<thead>
		<tr>
			<th>Descripcion</th>
			<th>Cantidad</th>
			<th>Precio</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach(json_decode($pedido->contenido) as $pc){ ?>
			<tr>
				<td><?php echo $pc->nombre; ?></td>
				<td><?php echo $pc->cantidad; ?></td>
				<td><?php echo __dinero($pc->precio); ?></td>
			</tr>
		<?php } ?>
		<!-- <tr style="text-align:right;">
			<td colspan="2" style="text-align:right;">SUBTOTAL</td>
			<td class="total" style="text-align:right;">$5,200.00</td>
		</tr>
		<tr style="text-align:right;">
			<td colspan="2" style="text-align:right;">TAX 25%</td>
			<td class="total" style="text-align:right;">$1,300.00</td>
		</tr> -->
		<tr style="text-align:right;">
			<td colspan="2" class="grand total" style="text-align:right;">Total</td>
			<td class="grand total" style="text-align:right;"><?php echo __dinero($pedido->total_pedido); ?></td>
		</tr>
		</tbody>
	</table>
	<div id="notices">
		<div>COMENTARIOS:</div>
		<div class="notice"><?php echo $pedido->comentarios; ?></div>
	</div>
</main>
<footer>
	Gumen Catering S.L.
</footer>
</body>
</html>
