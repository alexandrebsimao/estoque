<?php
	echo form_open(current_url(),array('class'=>''));
	
	echo form_label('Nome:','nome');
	echo form_input($nome);

	echo form_label('Categoria:','categoria');
	echo form_dropdown('categoria', $categorias, set_value('categoria', $set_categoria), "class='form-control'");

	echo form_label('Descrição:','descricao');
	echo form_textarea($descricao);

	echo br(2);

	echo form_submit($salvar);

	echo form_close();
?>