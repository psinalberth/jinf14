<?php echo $this->Form->create( 'Atividades', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">

	<?php
		print $this->BForm->input( 'Atividade.nome_atividade', array( 'label' => 'Nome da Atividade', 'placeholder' => 'Nome da Atividade' ) );
		print $this->BForm->input( 'Atividade.descricao', array( 'label' => 'Descrição',  'placeholder' => "data descrição", 'type' => 'text') );
		print $this->BForm->input( 'Atividade.tipo_atividade_id', array( 'label' => 'Tipo de Atividade', 'empty' => '-- Selecione --' , 'options'=> $tipo_atividades) );
		print $this->BForm->input( 'Atividade.duracao', array( 'label' => 'Duração',  'placeholder' => " descrição", 'type' => 'text') );	
		print $this->BForm->input( 'Atividade.vagas', array( 'label' => 'Total  vagas',  'placeholder' => "Vagas", 'type' => 'text') );		
	?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/atividades' ) ) ?>