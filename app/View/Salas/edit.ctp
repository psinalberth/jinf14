<?php echo $this->Form->create('Salas', array('class' => 'form-horizontal')); ?>

<div class="row">
	<div class="span5 offset3">
		<?php
			print $this->BForm->input('Sala.descricao', array('label' => 'Descrição', 'placeholder' => 'Nome da Sala', 'style' => 'width: 100%'));
			print $this->BForm->input('Sala.localidade', array('label' => 'Localização', 'placeholder' => 'Localização', 'style' => 'width: 100%'));
			print $this->BForm->input('Sala.departamento_id', array( 'label' => 'Departamento','options'=> $departamento, 'style' => 'width: 103%'));
		?>
	</div>
</div>

<?php echo $this->element( "submit", array( 'cancel' => '/salas' ) ) ?>