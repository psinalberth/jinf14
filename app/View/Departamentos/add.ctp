<?php echo $this->Form->create( 'Departamentos', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6 offset4">
		<?php
			print $this->BForm->input( 'Departamento.name', array( 'label' => 'Departamento', 'placeholder' => 'Nome do Departamento' ) );
		?>
	</div>
</div>

<?php echo $this->element( "submit", array( 'cancel' => '/departamentos' ) ) ?>