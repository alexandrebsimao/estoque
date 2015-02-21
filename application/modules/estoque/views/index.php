<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Produto</th>
			<th width="110">Qtd. Estoque</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($estoque as $est): ?>
			<tr>
				<td><?php echo $est->id; ?></td>
				<td><?php echo $est->nome; ?></td>
				<td><?php echo $est->quantidade; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>