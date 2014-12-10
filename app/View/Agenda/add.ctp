 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
 <script>
  $(function() {
    $( "#asds" ).datepicker();
    $( "#sds" ).datepicker();
  });
  </script>
     <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#AgendaHorarioIni').ptTimeSelect();
            $('#AgendaHorarioFim').ptTimeSelect();
        });
    </script>
<?php echo $this->Html->css('jquery.ptTimeSelect.css');?>
<?php echo $this->Html->script('jquery.ptTimeSelect.js');?>
<?php echo $this->Form->create( 'Agenda', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">

	<?php
		print $this->Form->hidden( 'Agenda.data', array('value' => $data));
		print $this->BForm->input( 'Agenda.horario_ini', array( 'label' => 'Horário Inicio', 'type' => 'text') );
		print $this->BForm->input( 'Agenda.horario_fim', array( 'label' => 'Horário Fim', 'type' => 'text'  ) );
		print $this->BForm->input( 'Agenda.atividade_id', array( 'label' => 'Atividade', 'empty' => '-- Selecione --' , 'options'=> $atividades) );
		print $this->BForm->input( 'Agenda.sala_id', array( 'label' => 'Sala', 'empty' => '-- Selecione --' , 'options'=> $salas) );
		print $this->BForm->input( 'Agenda.edicao_id', array( 'label' => 'Edição', 'empty' => '-- Selecione --' , 'options'=> $edicoes) );		
		print $this->BForm->input( 'Agenda.total_vagas', array( 'label' => 'Total Vagas', 'type' => 'text') );		
		?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/agenda' ) ) ?>