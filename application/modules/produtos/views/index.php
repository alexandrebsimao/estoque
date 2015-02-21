<p><a href="<?php echo base_url(); ?>produtos/novo" class="btn btn-primary pull-right">Novo Produto</a></p>

<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>Categoria</th>
			<th width="20">Editar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($produtos as $produto): ?>
			<tr>
				<td><?php echo $produto->id; ?></td>
				<td><?php echo $produto->nome; ?></td>
				<td><?php echo $produto->categoria; ?></td>
				<td><center><a href="<?php echo base_url().'produtos/editar/'.$produto->id; ?>" class="icon glyphicon glyphicon-edit"></a></center></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>