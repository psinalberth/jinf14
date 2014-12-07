<?php echo $this->Form->create( null, array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">
        
        <?php if ($tipo_atividades):?>
            <?php foreach ($tipo_atividades as $tipo_atividade): ?>
            <h2><?=$tipo_atividade['TipoAtividade']['nome']?></h2>
                <?php 
                     foreach ($tipo_atividade['Atividade'] as $atividade):
                        //$options[] = array($atividade['id'] => $atividade['nome_atividade']);
                     
                     echo $this->Form->input("Atividade.{$atividade['nome_atividade']}", array('type' => 'checkbox', 'options' => array($atividade['id'] => $atividade['nome_atividade'])));
                      endforeach;
                ?>
            
            <?php endforeach;?>
        <?php endif;?>
	<?php
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.email', array( 'label' => 'E-mail', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		print $this->BForm->input( 'User.nome', array( 'label' => 'Nome', 'placeholder' => 'Digite aqui seu Nome' ) );
		
		?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/atividades' ) ) ?>