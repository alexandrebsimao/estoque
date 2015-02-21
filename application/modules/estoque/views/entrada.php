<?php echo form_open(current_url(),array('class'=>'')); ?>
	<table cellpadding="0" cellspacing="0" width="30%" class="tbl-dinamic table">
		<thead>
			<tr>
				<th>Quantidade</th>
				<th>Produto</th>
				<th width="30"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo form_input($quantidade); ?></td>
				<td><?php echo form_dropdown('produto[]',$produtos, '', "class='form-control' required='required'"); ?></td>
				<td><button type="button" class="row-remove btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><button type="button" class="row-add btn btn-success"><i class="glyphicon glyphicon-plus"></i></button></td>
			</tr>
		</tfoot>
	</table>

	<?php echo form_submit($salvar); ?>

<?php echo form_close(); ?>
