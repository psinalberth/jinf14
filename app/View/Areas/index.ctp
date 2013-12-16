<table class="list medium">
	
<tr class="head">
	<th></th>
	<th><?php echo $this->Paginator->sort( "Controller", "controller" ) ?></th>
	<th><?php echo $this->Paginator->sort( "Action", "action" ) ?></th>
	<th class="actions">A&ccedil;&otilde;es</th>
</tr>

<?php foreach( $areas as $i => $area ): $i % 2 ? $class = null : $class = ' class="altrow"'; ?>

<tr<?php echo $class ?>>
	<td class="pic Areas"></td>
	<td><?php echo $area[ 'Area' ][ 'controller' ] ?></td>
	<td><?php echo $area[ 'Area' ][ 'action' ] ?></td>
	<td>
	<?php
		print $this->Html->link( "Editar", "/areas/edit/{$area['Area']['id']}", array( 'class' => 'icon edit' ) );
		print $this->Html->link( "Excluir", "/areas/delete/{$area['Area']['id']}", array( 'class' => 'icon delete' ), "Tem certeza de que deseja excluir esta Área?" );
	?>
	</td>
</tr>
	
<?php endforeach; print $this->element( "paginationButtons", array( 'mode' => 'table', 'size' => 4 ) ) ?>

</table>