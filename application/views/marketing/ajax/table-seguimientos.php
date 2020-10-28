<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped mt-3">
		<tbody>
		<thead>
		<tr>
			<td class="py-3">Referéncia</td>
			<td class="py-3">Nombre</td>
			<td class="py-3">Descipción</td>
			<td class="py-3">Medio</td>
			<td class="py-3">Acciones</td>
		</tr>
		</thead>
		</thead>
		<tbody>
		<?php if(!empty($seguimientos)){
			foreach($seguimientos as $seguimiento){
				?>
				<tr>
					<td><?php echo $seguimiento->referencia ?></td>
					<td><?php echo $seguimiento->nombre ?></td>
					<td><?php echo $seguimiento->descripcion ?></td>
					<td><?php echo $seguimiento->medio ?></td>
					<td class="p-1"><button class="btn btn-transparent border btn-block btn-edit" data-id="<?php echo $seguimiento->id ?>'">Ver</button></td>
				</tr>
			<?php }
		}?>
		</tbody>
	</table>
</div>
