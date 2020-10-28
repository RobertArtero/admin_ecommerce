<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped mt-3">
		<tbody>
		<thead>
		<tr>
			<td class="py-3">Nombre</td>
			<td class="py-3">Email</td>
			<td class="py-3">Estado</td>
			<td class="py-3">Acciones</td>
		</tr>
		</thead>
		</thead>
		<tbody>
		<?php if($administradores){
			foreach($administradores as $administrador){
				?>
				<tr>
					<td><?php echo $administrador->nombre ?> </td>
					<td><?php echo $administrador->email ?> </td>
					<td class="py-3"><?php echo ($administrador->activo) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>No activo</span>"; ?></td>
					<td class="p-1"><button class="btn btn-transparent border btn-block btn-edit" data-id="<?php echo $administrador->id ?>'">Ver</button></td>
				</tr>
			<?php }
		}?>
		</tbody>
	</table>
</div>
