<?php echo $this->Form->create('Agenda', array( 'controller' => 'nscricoes', 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">
 	<?php
		print $this->BForm->input( 'User.name', array( 'label' => 'Nome:', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.email', array( 'label' => 'E-mail', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.telefone', array( 'label' => 'Telefone:', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.curso_id', array( 'label' => 'Curso:', 'type' => 'select', 'options' => $cursos, 'empty' => '--' ));
        ?>       

       <?php if ($options_checkbox_atividades):?>
         <div class="control-group">
             <fieldset>
            <?php
 
                    print $this->Form->label( 'Agenda', 'Atividades:', array( 'class' => 'control-label' ) );
                    print $this->Form->input( 'Agenda.Agenda', array( "label" => false,'type'=>'select', 'div' => 'controls agenda', 'escape' => false, 'multiple' => 'checkbox', 'options' => $options_checkbox_atividades) );
            
                    if (!empty ($erro_horario_conflito)){
                        print '<div class="controls required error"><span style="color:#b94a48">' . $erro_horario_conflito . '</span></div>';
  
                    }
                    
                    if (!empty ($erro_vagas)){
                        print '<div class="controls required error"><span style="color:#b94a48">' . $erro_vagas . '</span></div>';
                    }
            ?>
             
            </fieldset>     
        <?php endif;?>
        </div>
	</div>

</div>

<div class="form-actions">
	<p class="required"><span class="req">*</span> campos de preenchimento obrigat&oacute;rio</p>
	<?php
	 	print $this->Form->button( '<i class="icon-check icon-white"></i> Enviar', array( 'class' => 'btn btn-primary pull-left submit', 'div' => false, 'escape' => false ) );
	?>
	<div class="spinner"></div>
</div>

<?= $this->Form->end() ?>