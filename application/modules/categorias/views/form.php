<?php
	echo form_open(current_url(),array('class'=>''));
	
	echo form_label('Nome:','nome');
	echo form_input($nome);

	echo br(2);

	echo form_submit($salvar);

	echo form_close();
?>