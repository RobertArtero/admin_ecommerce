<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Administrador <?php echo __pm($this->nombre_empresa); ?></title>
	<link href="<?php echo base_url("assets") ?>/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href="<?php echo base_url("assets") ?>/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.css">
	<link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.auth.css">
	<link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/dashforge.dashboard.css">
	<link rel="stylesheet" href="<?php echo base_url("assets") ?>/css/administrador.css">

	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<script src="<?php echo base_url("assets") ?>/lib/jquery/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


	<link href="<?php echo base_url("assets") ?>/lib/quill/quill.core.css" rel="stylesheet">
	<link href="<?php echo base_url("assets") ?>/lib/quill/quill.snow.css" rel="stylesheet">

	<script type="text/javascript" src="<?php echo base_url("assets") ?>/lib/quill/quill.min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgD17T27xE718nB2YUCFnAgCrwPmtgnW4&libraries=places"></script>


	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<link href="<?php echo base_url("assets") ?>/css/spectrum.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url("assets") ?>/js/spectrum.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">


</head>
<body>
<div class="loading text-center centered">
	<div style="transform: translateY(50%);" class="h-100">
		<div class="spinner-border centered text-center" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
</div>

<script>
let BASE_URL = "<?php echo base_url(); ?>";
let loading = $(".loading");
</script>
