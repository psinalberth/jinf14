<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $sala['Sala']['descricao'] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/salas/delete/{$sala['Sala']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/salas/edit/{$sala['Sala']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Descricao</td>
			<td class="data"><?php echo $sala['Sala']['descricao'] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Localização</td>
			<td class="data"><?php echo $sala['Sala']['localidade'] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Departamento</td>
			<td class="data"><?php echo $departamento['Departamento']['name'] ?></td>	
		</tr>
	</tbody>
	</table>
</div>

<?php echo $this->element( 'deleteModal', array( 'model' => 'Sala' ) ) ?>