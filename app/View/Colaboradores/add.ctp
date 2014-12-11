<?php echo $this->Form->create( 'Colaborador', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">

	<?php
// 'id_usuario', 'id_Colaborador','funcao'
	
		
		print $this->BForm->input( 'Colaborador.user_id', array( 'label' => 'Usuario', 'empty' => '-- Selecione --' , 'options'=> $users) );
		print $this->BForm->input( 'Colaborador.programacao_id', array( 'label' => 'Atividade', 'empty' => '-- Selecione --' , 'options'=> $atividade) );
		print $this->BForm->input( 'Colaborador.funcao', array( 'label' => 'funcao',  'placeholder' => "funcao", 'type' => 'text') );	
		?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/Colaborador' ) ) ?>