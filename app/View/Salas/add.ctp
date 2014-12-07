<?php echo $this->Form->create('Salas', array('class' => 'form-horizontal')); ?>

<div class="row">
	<div class="span6 offset4">
		<?php
			print $this->BForm->input('Sala.descricao', array('label' => 'Descrição', 'placeholder' => 'Nome da Sala'));
			print $this->BForm->input('Sala.localidade', array('label' => 'Localização', 'placeholder' => 'Localização'));
			print $this->BForm->input('Sala.departamento_id', array( 'label' => 'Departamento', 'empty' => '-- Selecione --' , 'options'=> $departamento));
		?>
	</div>
</div>

<?php echo $this->element( "submit", array( 'cancel' => '/salas' ) ) ?>