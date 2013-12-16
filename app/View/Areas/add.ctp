<?php echo $this->Form->create( 'Area', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">
	<?php
		print $this->BForm->input( 'Area.controller', array( 'label' => 'Controller' ) );
		print $this->BForm->input( 'Area.controller_label', array( 'label' => 'Controller Label') );
		print $this->BForm->input( 'Area.action', array( 'label' => 'Action'));
		print $this->BForm->input( 'Area.action_label', array( 'label' => 'Action Label' ) );
	?>
	</div>

	
</div>

<?php echo $this->element( "submit", array( 'cancel' => '/users' ) ) ?>