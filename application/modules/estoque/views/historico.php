<table class="table">
	<thead>
		<tr>
			<th>Entrada/Saida</th>
			<th>Produto</th>
			<th>Data Movimentação</th>
			<th width="110">Quantidade</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($historico as $hist): ?>
			<tr>
				<td><?php echo ($hist->tipo=='E')?'Entrada':'Saida'; ?></td>
				<td><?php echo $hist->nome; ?></td>
				<td><?php echo $hist->data_hora_movimentacao; ?></td>
				<td><?php echo $hist->quantidade; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>