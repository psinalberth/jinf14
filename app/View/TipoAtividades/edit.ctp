<?php echo $this->Form->create( 'TipoAtividade', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">

	<?php
		print $this->BForm->input( 'TipoAtividade.nome', array( 'label' => 'Nome do Tipo da Atividade', 'placeholder' => 'Nome do Tipo da Atividade' ) );
		?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/TipoAtividades' ) ) ?>