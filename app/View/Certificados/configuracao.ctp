<?php echo $this->Form->create( 'ConfigCertificado', array( 'url' => array('controller' => 'certificados', 'action' => 'configuracao'),  'class' => 'form-horizontal', 'type' => 'file') ); ?>

<div class="row">
	<div class="span6">

	<?php
                print $this->BForm->input('ConfigCertificado.edicao_id', array('label' => 'Escolha a edição do certificado:', 'type' => 'select', 'options' => $options, 'empty' => '--'));
		print $this->BForm->input( 'ConfigCertificado.titulo', array( 'label' => 'Titulo Certificado:', 'placeholder' => 'Titulo Certificado' ) );
		print $this->BForm->input( 'ConfigCertificado.texto_antes', array( 'label' => 'Texto antes do nome:',  'placeholder' => "Texto antes do nome:", 'type' => 'textarea') );
		print $this->BForm->input( 'ConfigCertificado.texto_depois', array( 'label' => 'Texto depois do nome:', 'placeholder' => "Texto depois do nome:", 'type' => 'textarea') );
		print $this->BForm->input( 'ConfigCertificado.coordenador', array( 'label' => 'Nome Coordenador:',  'placeholder' => "Nome Coordenador", 'type' => 'text') );	
		print $this->BForm->input( 'ConfigCertificado.label_coordenador', array( 'label' => 'label abaico do nome do coordenador:',  'placeholder' => "Nome Coordenador", 'type' => 'text') );	
		print $this->BForm->input( 'ConfigCertificado.imagem_fundo', array( 'label' => 'Imagem fundo (297 X 210 dpi):', 'type' => 'file') );	
		print $this->BForm->input( 'ConfigCertificado.imagem_topo', array( 'label' => 'Imagem topo certificado:', 'type' => 'file') );	
		print $this->BForm->input( 'ConfigCertificado.imagem_assinatura_coord', array( 'label' => 'Imagem assinatura do coordenador:', 'type' => 'file') );	
		?>

	</div>

</div>

<?php echo $this->element( "submit", array( 'cancel' => '/atividades' ) ) ?>