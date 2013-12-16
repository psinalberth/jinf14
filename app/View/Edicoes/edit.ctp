 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
 <script>
  $(function() {
    $( "#EdicaoDataIni" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#EdicaoDataFim" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>

	<?php
		echo $this->Form->create( 'Edicao', array( 'class' => 'form-horizontal' ) );
		print $this->Form->hidden( 'Edicao.cod_edicao' );
		print $this->BForm->input( 'Edicao.nome', array( 'label' => 'Nome do Evento', 'placeholder' => 'Nome do Evento' ) );
		print $this->BForm->input( 'Edicao.data_ini', array( 'label' => 'Data Inicio',  'placeholder' => "data inicio", 'type' => 'text') );
		print $this->BForm->input( 'Edicao.data_fim', array( 'label' => 'Data Fim',  'placeholder' => "data fim", 'type' => 'text') );
		print $this->BForm->input( 'Edicao.ano', array( 'label' => 'Ano',  'placeholder' => "ano", 'type' => 'text') );
		print $this->BForm->input( 'Edicao.local', array( 'label' => 'Local',  'placeholder' => "ano", 'type' => 'text') );
	?>


<?php echo $this->element( "submit", array( 'cancel' => "/edicoes/view/{$this->passedArgs[0]}" ) ) ?>