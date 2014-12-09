<?php echo $this->Form->create('Agenda', array( 'controller' => 'nscricoes', 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">
         <h2>Dados participante</h2>
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
                    print $this->Form->input( 'User.Agenda', array( "label" => false,'type'=>'select', 'div' => 'controls agenda', 'escape' => false, 'multiple' => 'checkbox', 'options' => $options_checkbox_atividades) );
            ?>
            </fieldset>     
        <?php endif;?>
        </div>
	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/inscricoes' ) ) ?>