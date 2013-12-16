<?php
 	print $this->Form->create( "Area", array( "action" => "edit", "class" => "form" ) );
	print $this->Form->hidden( "Area.id" );
?>

<table class="visualizar auto">
	<tr>
		<td class="label"><?php echo $this->Form->label( "Area.controller", "Controller:" ) ?></td>
		<td class="input"><?php echo $this->Form->input( "Area.controller", array( 'label' => false, 'class' => 'text' ) ) ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->label( "Area.controller_label", "Controller Label:" ) ?></td>
		<td><?php echo $this->Form->input( "Area.controller_label",  array( 'label' => false, 'class' => 'text' ) ) ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->label( "Area.action", "Action:" ) ?></td>
		<td><?php echo $this->Form->input( "Area.action",  array( 'label' => false, 'class' => 'text' ) ) ?></td>
	</tr>
	<tr>
		<td><?php echo $this->Form->label( "Area.action_label", "Action Label:" ) ?></td>
		<td><?php echo $this->Form->input( "Area.action_label",  array( 'label' => false, 'class' => 'text' ) ) ?></td>
	</tr>
	<tr>
		<td colspan="2">
		<?php
		 	print $this->Form->submit( "SALVAR", array( 'class' => 'submit' ) );
			print $this->Form->submit( "CANCELAR", array( 'class' => 'submit cancel' ) )
		?>
		</td>
	</tr>
</table>

<?php echo $this->Form->end() ?>