<p><a href="<?php echo base_url(); ?>categorias/novo" class="btn btn-primary pull-right">Nova Categoria</a></p>

<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th width="20">Editar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categorias as $categoria): ?>
			<tr>
				<td><?php echo $categoria->id; ?></td>
				<td><?php echo $categoria->nome; ?></td>
				<td><center><a href="<?php echo base_url().'categorias/editar/'.$categoria->id; ?>" class="icon glyphicon glyphicon-edit"></a></center></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>