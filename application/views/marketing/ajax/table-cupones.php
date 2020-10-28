<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped mt-3">
		<tbody>
		<thead>
		<tr>
			<td class="py-3">Código</td>
			<td class="py-3">Nombre</td>
			<td class="py-3">Descuento</td>
			<td class="py-3">Periodo</td>
			<td class="py-3">Acciones</td>
		</tr>
		</thead>
		</thead>
		<tbody>
		<?php if(!empty($cupones)){
			foreach($cupones as $cupon){
				?>
				<tr>
					<td><?php echo $cupon->codigo ?></td>
					<td><?php echo $cupon->nombre ?></td>
					<td><?php echo $cupon->descuento ?></td>
					<td><?php echo $cupon->fecha_inicio .' / '. $cupon->fecha_final ?></td>
					<td class="p-1"><button class="btn btn-transparent border btn-block btn-edit" data-id="<?php echo $cupon->id ?>'">Ver</button></td>
				</tr>
			<?php }
		}?>
		</tbody>
	</table>
</div>
