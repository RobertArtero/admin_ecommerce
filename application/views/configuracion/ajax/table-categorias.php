<div class="table-responsive">
	<table class="table table-hover table-bordered table-striped mt-3">
		<tbody>
		<thead>
		<tr>
			<td class="py-3">Nombre</td>
			<td class="py-3">Estado</td>
			<td class="py-3">Acciones</td>
		</tr>
		</thead>
		</thead>
		<tbody>
		<?php if($categorias){
			foreach($categorias as $categoria){
				?>
				<tr>
					<td><?php echo $categoria->nombre ?> </td>
					<td class="py-3"><?php echo ($categoria->activo) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>No activo</span>"; ?></td>
					<td class="p-1"><button class="btn btn-transparent border btn-block btn-edit" data-id="<?php echo $categoria->id ?>'">Ver</button></td>
				</tr>
			<?php }
		}?>
		</tbody>
	</table>
</div>
