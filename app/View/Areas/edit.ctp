<?php echo $this->Form->create( 'Area', array( 'class' => 'form-horizontal' ) ); ?>

<div class="row">
	<div class="span6">
	<?php
		print $this->BForm->input( 'Area.id', array( 'label' => 'Controller', 'type' => 'hidden' ) );
		print $this->BForm->input( 'Area.controller', array( 'label' => 'Controller' ) );
		print $this->BForm->input( 'Area.controller_label', array( 'label' => 'Controller Label') );
		print $this->BForm->input( 'Area.action', array( 'label' => 'Action'));
		print $this->BForm->input( 'Area.action_label', array( 'label' => 'Action Label' ) );
		print $this->BForm->input( 'Area.appear', array( 'label' => 'Aparecer como menu' , 'type' => 'checkbox', 'required' => false) );
		print $this->BForm->input( 'Area.parent_id', array( 'label' => 'Parecer abaixo de:' , 'type' => 'select', 'options' => $parent_id, 'empty' => '--', 'required' => false) );
	?>
	</div>

	
</div>

<?php echo $this->element( "submit", array( 'cancel' => '/Area' ) ) ?>